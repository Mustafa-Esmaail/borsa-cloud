<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TransactionStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\HolderStoreRequest;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\ManualOffice;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\OfficeCurrency;
use App\Models\Transaction;
use App\Models\TransactionConfirm;
use App\Models\TransactionHolder;
use App\Notifications\officeNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class TransactionController extends Controller
{

    public function index()
    {
        // المستلمه و المرسله
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where('transactions_type', 'transactions')->where('sender_id', $office_id)->orWhere('receiver_id', $office_id)
            ->with(['user', 'Reciver', 'Sender', 'currency'])->get();

        foreach ($transactions as $transaction) {
            $transaction->currency->currencyName = $transaction->currency->currency->name;
            unset($transaction->currency->currency);
        }
        return response()->json(['success' => 'transactions retrived succefull', 'data' => $transactions], 200);
    }



    public function office(string $id)
    {
        // المستلمه و المرسله
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::whereNull('office_type')->where('transactions_type', 'transactions')->where(function ($query) use ($office_id, $id) {
            $query->where('sender_id', $office_id)->Where('receiver_id', $id);
        })->orWhere(function ($query) use ($office_id, $id) {
            $query->where('sender_id', $id)->Where('receiver_id', $office_id);
        })->with(['user', 'Reciver', 'Sender', 'currency'])->get();

        if ($transactions) {
            foreach ($transactions as $transaction) {
                $transaction->currency->currencyName = $transaction->currency->currency->name;
                unset($transaction->currency->currency);
            }
            return response()->json(['success' => 'transactions retrived succefull', 'data' => $transactions], 200);
        } else {
            return response()->json(['failed' => 'transactions not found ',], 404);
        }
    }
    public function officeSummry(string $id)
    {
        // المستلمه و المرسله
        $data = [];
        $office_id = auth()->user()->office_id;
        // $sent = Transaction::where('sender_id', $office_id)->Where('receiver_id', $id)->get();
        // $resived = Transaction::where('sender_id', $id)->Where('receiver_id', $office_id)->get();

        $transactions = Transaction::whereNull('office_type')->where(function ($query) use ($office_id, $id) {
            $query->where('sender_id', $office_id)->Where('receiver_id', $id);
        })->orWhere(function ($query) use ($office_id, $id) {
            $query->where('sender_id', $id)->Where('receiver_id', $office_id);
        })->with(['user', 'Reciver', 'Sender', 'currency'])->get();



        if ($transactions) {
            $data['office'] = Office::find($id);
            foreach ($transactions as $transaction) {
                $key =   $transaction->currency->currency->name;
                if ($transaction->sender_id == $office_id) {
                    if (array_key_exists($key, $data)) {
                        $data[$key]['amount'] -= $transaction->amount;
                    } else {
                        $data[$key]['amount'] = $transaction->amount;
                    }
                } else {
                    if (array_key_exists($key, $data)) {
                        $data[$key]['amount'] += $transaction->amount;
                    } else {
                        $data[$key]['amount'] = $transaction->amount;
                    }
                }
            }

            return response()->json(['success' => 'transactions retrived succefull', 'data' => $data], 200);
        } else {
            return response()->json(['failed' => 'transactions not found ',], 404);
        }
    }

    public function Manualoffice(string $id)
    {
        // المستلمه و المرسله
        $office_id = auth()->user()->office_id;
        
        $transactions = Transaction::where('sender_id', $office_id)->where('receiver_id', $id)->whereNotNull('office_type')->with(['user', 'ManualReciver', 'Sender', 'currency'])->get();
        if ($transactions) {
            foreach ($transactions as $transaction) {
                $transaction->currency->currencyName = $transaction->currency->currency->name;
                unset($transaction->currency->currency);
            }
          
            return response()->json(['success' => 'transactions retrived succefull', 'data' => $transactions], 200);
        } else {
            return response()->json(['failed' => 'transactions not found '], 404);
        }
    }
    public function store(TransactionStoreRequest $request)
    {
        //
        $Roffice = false;
        $data = $request->all();
        // dd($data['sender_name']);

        $currencyOffice = OfficeCurrency::where('office_id', auth()->user()->office_id)->where('currency_id', $data['currency_id'])->first();

        $Soffice = Office::where('id', '=', auth()->user()->office_id)->first();
        if ($request->office_type == 'manual') {
            $Roffice = ManualOffice::where('id', '=', $data['receiver_id'])->first();
        } else {
            $Roffice = Office::where('id', '=', $data['receiver_id'])->first();
        }
        if ($Roffice) {
            if ($currencyOffice) {
                if ($request->transactions_type == 'bill') {
                    $data['type'] = 'مستلمه';
                }
                $transaction = Transaction::create([
                    'amount' => $data['amount'],
                    'sender_id' => auth()->user()->office_id,
                    'receiver_id' => $data['receiver_id'],
                    'sender_name'=> $data['sender_name'],
                    'receiver_name' => $data['receiver_name'],
                    'total_amount' => $data['total_amount'],
                    'date' => $data['date'],
                    'currency_id' => $data['currency_id'],
                    'percentage' => $data['percentage'],
                    'notes' => $data['notes'],
                    'status' => 'send',
                    'type' => $data['type'],
                    'office_type' => $request->office_type,
                    'user_id' => auth()->user()->id,
                    'transactions_type' => $request->transactions_type ? $request->transactions_type : 'transactions',
                ]);
                if ($data['type'] == 'مستلمه') {
                    //قبض
                    $currencyOffice->withdraw(intval($data['amount']));

                    if ($request->office_type != 'manual') {
                        $RcurrencyOffice = OfficeCurrency::where('office_id', $data['receiver_id'])->where('currency_id',  $data['currency_id'])->first();
                        if ($RcurrencyOffice) {
                            $RcurrencyOffice->deposit($data['amount']);
                        } else {
                            $RcurrencyOffice = OfficeCurrency::create([
                                'office_id'  =>  $data['receiver_id'],
                                'currency_id'  => $data['currency_id'],
                                'wallet_balance' => $data['amount']
                            ]);
                        }
                    }
                } else {
                    $currencyOffice->deposit($data['amount']);

                    if ($request->office_type != 'manual') {
                        $RcurrencyOffice = OfficeCurrency::where('office_id', $data['receiver_id'])->where('currency_id',  $data['currency_id'])->first();
                        if ($RcurrencyOffice) {
                            $RcurrencyOffice->withdraw($data['amount']);
                        } else {
                            $RcurrencyOffice = OfficeCurrency::create([
                                'office_id'  =>  $data['receiver_id'],
                                'currency_id'  => $data['currency_id'],
                                'wallet_balance' => $data['amount']
                            ]);
                        }
                    }
                }


                if (!$request->transactions_type == 'bill' && !$request->office_type == 'manual') {
                    $office = Office::find($data['receiver_id']);
                    $notification['title'] = 'ارسال حواله';
                    $notification['message'] = ' قام المكتب ' . $office->office_name . ' بارسال حواله';
                    $notification['data'] = $transaction;

                    Notification::send($office, new officeNotification($notification));
                }

                return response()->json(['success' => 'transaction add succefull', 'data' => $transaction], 200);
            } else {
                return response()->json(['error' => "Currency Not Found"], 304);
            }
        } else {
            return response()->json(['error' => 'Reciver office Not found '], 304);
        }
    }


    public function show(string $id)
    {
        //
        $transactions = Transaction::where('id', $id)->with(['user', 'Reciver', 'Sender', 'currency'])->first();
        if ($transactions) {
            $transactions->currency->currencyName = $transactions->currency->currency->name;
            unset($transactions->currency->currency);
            return response()->json(['success' => 'transaction retived succefull', 'data' => $transactions], 200);
        } else {
            return response()->json(['erorr' => 'transaction   Not Found ', 'data' => $transactions], 304);
        }
    }




    public function update(TransactionUpdateRequest $request, string $id)
    {
        //
        $data =  $request->all();
        $transaction = Transaction::find($id);
        if ($transaction ) {
            if ($request->office_type && $request->office_type == 'manual') {
                $transaction->update([$request->office_type => 'manual']);
                return response()->json(['message' => "Transaction Updated  Successfully"], 201);
            } else {
                $transactionConfirm = TransactionConfirm::create([
                    'amount' => $data['amount'],
                    'sender_id' => auth()->user()->office_id,
                    'receiver_id' => $transaction->receiver_id,
                    'sender_name'=> $data['sender_name'],
                    'receiver_name' => $data['receiver_name'],
                    'total_amount' => $data['total_amount'],
                    'date' => $data['date'],
                    'currency_id' => $data['currency'],
                    'percentage' => $data['percentage'],
                    'notes' => $data['notes'],
                    'status' => $transaction->status,
                    'type' => $data['type'],
                    'action' => $data['action'],
                    'office_id' => auth()->user()->office_id,
                    'transaction_id' => $id,
                    'user_id' => auth()->user()->id,
                    'action_status' => 'wait',
                ]);
                $transaction->update(['status' => 'wait']);

                if ($transactionConfirm) {

                    $office = Office::find($transaction->receiver_id);
                    $notification['title'] = 'طلب نعديل حواله';
                    $notification['message'] = ' قام المكتب ' . $office->office_name . ' بتعديل حواله ';
                    $notification['data'] = $transactionConfirm;

                    Notification::send($office, new officeNotification($notification));
                    return response()->json(['message' => "Transaction Request Add Successfully"], 201);
                } else {
                    return response()->json(['error' => "Faild to edit Transaction Request  "], 405);
                }
            }
        } else {
            return response()->json(['error' => "Transaction not found"], 404);
        }
    }



    public function ConfirmUpdate(Request $request, string $id)
    {
        $request =  $request->response;
        $transactionConfirm = TransactionConfirm::where('transaction_id', $id)->first();
        $transaction = Transaction::find($id);
        if ($transactionConfirm) {
            if ($request == 'agreed') {
                $ScurrencyOffice = OfficeCurrency::where('office_id', $transaction->sender_id)->where('currency_id',  $transaction->currency_id)->first();
                $RcurrencyOffice = OfficeCurrency::where('office_id', $transaction->receiver_id)->where('currency_id',  $transaction->currency_id)->first();
                $ScurrencyOffice->deposit($transaction->amount);
                $RcurrencyOffice->withdraw($transaction->amount);
                $transaction->update([
                    'amount' => $transactionConfirm->amount,
                    'sender_id' => $transactionConfirm->sender_id,
                    'receiver_id' => $transactionConfirm->receiver_id,
                    'sender_name '=> $transactionConfirm->sender_name,
                    'receiver_name' => $transactionConfirm->receiver_name,
                    'total_amount' => $transactionConfirm->total_amount,
                    'date' => $transactionConfirm->date,
                    'currency_id' => $transactionConfirm->currency_id,
                    'percentage' => $transactionConfirm->percentage,
                    'notes' => $transactionConfirm->notes,
                    'status' => 'received',
                    'type' => $transactionConfirm->type,
                ]);
                $transactionConfirm->update([
                    'action_status' => 'agreed',
                ]);

                $ScurrencyOffice->withdraw($transactionConfirm->amount);
                $RcurrencyOffice->deposit($transactionConfirm->amount);
                if ($transaction) {
                    return response()->json(['message' => "Transaction updated  Successfully", 'transaction' => $transaction], 201);
                }
            } elseif ($request == 'disagreed') {


                $transactionConfirm->update(['action_status' => 'disagreed']);
                $transaction->update(['status' => 'send']);

                // notifications
                $office = Office::find($transaction->sender_id);
                $notification['title'] = 'رفض نعديل حواله';
                $notification['message'] = ' قام المكتب ' . $office->office_name . '  رفض بتعديل حواله ';
                $notification['data'] = $transaction;

                Notification::send($office, new officeNotification($notification));
                return response()->json(['message' => "Transaction Action disagreed  Successfully"], 201);
            }
        } else {
            return response()->json(['error' => "No such transaction request found."], 404);
        }
    }
    // public function transactionsConfirmRequests()
    // {
    //     //طلبات التعديل

    //     $office_id = auth()->user()->office_id;
    //     $transactions = TransactionConfirm::where('receiver_id', $office_id)->where('action_status', 'wait')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
    //     foreach ($transactions as $transaction) {
    //         $transaction->currency->currencyName = $transaction->currency->currency->name;
    //         unset($transaction->currency->currency);
    //     }
    //     return response()->json(['success' => 'transaction confirm requests retrived succefull', 'data' => $transactions], 200);
    // }
    // public function sentTransactions()
    // {
    //     // المستلمه للتاكيد
    //     $office_id = auth()->user()->office_id;
    //     $transactions = Transaction::where('receiver_id', $office_id)->where('status', 'send')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
    //     foreach ($transactions as $transaction) {
    //         $transaction->currency->currencyName = $transaction->currency->currency->name;
    //         unset($transaction->currency->currency);
    //     }
    //     return response()->json(['success' => 'sent Transactions retrived succefull', 'data' => $transactions], 200);
    // }


    // public function  receivedTransactions()
    // {
    //     // المرسله الموكده
    //     $office_id = auth()->user()->office_id;
    //     $transactions = Transaction::where('sender_id', $office_id)->where('status', 'received')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
    //     foreach ($transactions as $transaction) {
    //         $transaction->currency->currencyName = $transaction->currency->currency->name;
    //         unset($transaction->currency->currency);
    //     }
    //     return response()->json(['success' => 'received Transactions retrived succefull', 'data' => $transactions], 200);
    // }
    // public function deleteTransactions()
    // {
    //     //طلبات الحذف
    //     $office_id = auth()->user()->office_id;
    //     $transactions = Transaction::where('receiver_id', $office_id)->where('status', 'delete')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
    //     foreach ($transactions as $transaction) {
    //         $transaction->currency->currencyName = $transaction->currency->currency->name;
    //         unset($transaction->currency->currency);
    //     }
    //     return response()->json(['success' => ' Transactions Delete Requests retrived succefull', 'data' => $transactions], 200);
    // }
    public function DeleteReq($id)
    {
        //  'طلب' الحذف
        $transaction = Transaction::find($id);
        if ($transaction) {
            if ($transaction->office_type == 'manual') {
                $transaction->delete();
                return response()->json(['message' => "Transaction deleted  Successfully"], 201);
            } else {

                $transaction->update([
                    'status' => "delete",
                ]);

                $office = Office::find($transaction->receiver_id);
                $notification['title'] = 'طلب حذف حواله';
                $notification['message'] = ' قام المكتب ' . $office->office_name . ' بحذف حواله ';
                $notification['data'] = $transaction;

                Notification::send($office, new officeNotification($notification));
            }
            return response()->json(['success' => 'transaction delete  Requested  succefull'], 200);
        } else {
            return response()->json(['failed' => 'transaction not found succefull'], 404);
        }
    }
    public function confirmDelete(Request $request, $id)
    {
        //  تاكيد الحذف
        $transaction = Transaction::find($id);
        if ($transaction) {
            if ($request->status == 'delete') {
                $ScurrencyOffice = OfficeCurrency::where('office_id', $transaction->sender_id)->where('currency_id',  $transaction->currency_id)->first();
                $RcurrencyOffice = OfficeCurrency::where('office_id', $transaction->receiver_id)->where('currency_id',  $transaction->currency_id)->first();
                $ScurrencyOffice->deposit($transaction->amount);
                $RcurrencyOffice->withdraw($transaction->amount);
                $transaction->delete();
                return response()->json(['success' => "Transaction deleted  Successfully"], 201);
            } else {

                $transaction->update([
                    'status' =>  'send',
                ]);
                // notification
              $office = Office::find($transaction->sender_id);
              $notification['title'] = 'رفض حذف حواله';
              $notification['message'] = ' قام المكتب ' . $office->office_name . '  رفض حذف حواله ';
              $notification['data'] = $transaction;

              Notification::send($office, new officeNotification($notification));
                return response()->json(['message' => 'transaction deleted request has been rejected  '], 200);
            }
        } else {
            return response()->json(['failed' => 'transaction not found succefull',], 404);
        }
    }

    public function confirmRecived(Request $request, $id)
    {
        //  االمستلمه للتاكيد و الرفض
        $transaction = Transaction::find($id);
        if ($transaction) {
            if($request->status =="received"){
                $transaction->update([
                    // 'type' => 'مستلمه',
                    'status' => $request->status,

                ]);
            }
            elseif($request->status =="rejected"){
                $ScurrencyOffice = OfficeCurrency::where('office_id', $transaction->sender_id)->where('currency_id',  $transaction->currency_id)->first();
                $RcurrencyOffice = OfficeCurrency::where('office_id', $transaction->receiver_id)->where('currency_id',  $transaction->currency_id)->first();
                $ScurrencyOffice->deposit($transaction->amount);
                $RcurrencyOffice->withdraw($transaction->amount);
                $transaction->update([
                    // 'type' => 'مرسله',
                    'status' => $request->status,
                ]);
                // notification
              $office = Office::find($transaction->sender_id);
              $notification['title'] = 'رفض استلام حواله';
              $notification['message'] = ' قام المكتب ' . $office->office_name . '  رفض استلام حواله ';
              $notification['data'] = $transaction;

              Notification::send($office, new officeNotification($notification));
            }
            return response()->json(['success' => 'transaction '.$request->status.' succefull'], 200);
        } else {
            return response()->json(['failed' => 'transaction not found '], 404);
        }
    }
    public function transferDelivery(HolderStoreRequest $request, string $id)
    {
        $transactions = Transaction::find($id);

        if ($transactions) {
            $imagePath = $request->file('holder_img')->store('transactions_holder_imgs', 'public');
            $transactionHolder = TransactionHolder::create([
                'office_id' => auth()->user()->office_id,
                'user_id' => auth()->user()->id,
                'transaction_id' => $id,
                'holde_notes' => $request->holde_notes,
                'holder_img' => $imagePath,
            ]);
            $transactions->update([
                'type' => 'مستلمه',
            ]);
            return response()->json(['success' => 'transaction delivered succefull'], 200);
        } else {
            return response()->json(['failed' => 'transaction not found '], 404);
        }
    }
}

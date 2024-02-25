<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TransactionStoreRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionUpdateRequest;
use App\Models\ManualOffice;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\OfficeCurrency;
use App\Models\Transaction;
use App\Models\TransactionConfirm;
use App\Models\TransactionHolder;

class TransactionController extends Controller
{

    public function index()
    {
        // المستلمه و المرسله
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where(function ($query) use ($office_id) {
            $query->where('sender_id', $office_id)->orWhere('receiver_id', $office_id);
        })->with(['user', 'Reciver', 'Sender', 'currency'])->get();

        foreach ($transactions as $transaction) {
            $transaction->currency->currencyName = $transaction->currency->currency->name;
            unset($transaction->currency->currency);
        }
        return response()->json(['success' => 'transactions retrived succefull', 'data' => $transactions], 200);
    }


    public function store(TransactionStoreRequest $request)
    {
        //
        $Roffice = false;
        $data = $request->all();

        $currencyOffice = OfficeCurrency::where('office_id', auth()->user()->office_id)->where('currency_id', $data['currency'])->first();

        $Soffice = Office::where('id', '=', auth()->user()->office_id)->first();
        if ($request->office_type == 'manual') {
            $Roffice = ManualOffice::where('id', '=', $data['receiver_id'])->first();
        } else {
            $Roffice = Office::where('id', '=', $data['receiver_id'])->first();
        }
        if ($Roffice) {
            if ($currencyOffice) {
                $transaction = Transaction::create([
                    'amount' => $data['amount'],
                    'sender_id' => auth()->user()->office_id,
                    'receiver_id' => $data['receiver_id'],
                    'total_amount' => $data['total_amount'],
                    'date' => $data['date'],
                    'currency_id' => $data['currency'],
                    'percentage' => $data['percentage'],
                    'notes' => $data['notes'],
                    'status' => 'send',
                    'type' => $data['type'],
                    'office_type' => $request->office_type,
                    'user_id' => auth()->user()->id,
                ]);

                $imagePath = $request->file('holder_img')->store('transactions_holder_imgs', 'public');
                $transactionHolder = TransactionHolder::create([
                    'office_id' => auth()->user()->office_id,
                    'user_id' => auth()->user()->id,
                    'transaction_id' => $transaction->id,
                    'holde_notes' => $data['holde_notes'],
                    'holder_img' => $imagePath,
                ]);


                $currencyOffice->withdraw(intval($data['amount']));



                if ($request->office_type != 'manual') {
                    $RcurrencyOffice = OfficeCurrency::where('office_id', $data['receiver_id'])->where('currency_id',  $data['currency'])->first();
                    $RcurrencyOffice->deposit($data['amount']);
                }
                return response()->json(['success' => 'transaction add succefull', 'data' => $transaction, 'balance' => $Soffice->balance], 200);
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
            return response()->json(['erorr' => 'transaction to  Not Found ', 'data' => $transactions], 304);
        }
    }


    public function update(TransactionUpdateRequest $request, string $id)
    {
        //
        $data =  $request->all();
        $transaction = Transaction::find($id);
        if ($transaction) {
            if ($request->office_type && $request->office_type == 'manual') {
                $transaction->update([$request->office_type => 'manual']);
                return response()->json(['message' => "Transaction Updated  Successfully"], 201);
            } else {
                $transactionConfirm = TransactionConfirm::create([
                    'amount' => $data['amount'],
                    'sender_id' => auth()->user()->office_id,
                    'receiver_id' => $transaction->receiver_id,
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
                    return response()->json(['message' => "Transaction Request Add Successfully"], 201);
                } else {
                    return response()->json(['error' => "Faild to Add Transaction Request  "], 405);
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
                $transaction->update([
                    'amount' => $transactionConfirm->amount,
                    'sender_id' => $transactionConfirm->sender_id,
                    'receiver_id' => $transactionConfirm->receiver_id,
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
                if ($transaction) {
                    return response()->json(['message' => "Transaction updated  Successfully", 'transaction' => $transaction], 201);
                }
            } elseif ($request == 'disagreed') {
                $transactionConfirm->update(['action_status' => 'disagreed']);
                $transaction->update(['status' => 'received',]);
                return response()->json(['message' => "Transaction Action disagreed  Successfully"], 201);
            }
        } else {
            return response()->json(['error' => "No such transaction request found."], 404);
        }
    }
    public function transactionsConfirmRequests()
    {
        //طلبات التعديل

        $office_id = auth()->user()->office_id;
        $transactions = TransactionConfirm::where('receiver_id', $office_id)->where('action_status', 'wait')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
        foreach ($transactions as $transaction) {
            $transaction->currency->currencyName = $transaction->currency->currency->name;
            unset($transaction->currency->currency);
        }
        return response()->json(['success' => 'transaction confirm requests retrived succefull', 'data' => $transactions], 200);
    }
    public function sentTransactions()
    {
        // المستلمه للتاكيد
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where('receiver_id', $office_id)->where('status', 'send')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
        foreach ($transactions as $transaction) {
            $transaction->currency->currencyName = $transaction->currency->currency->name;
            unset($transaction->currency->currency);
        }
        return response()->json(['success' => 'sent Transactions retrived succefull', 'data' => $transactions], 200);
    }


    public function  receivedTransactions()
    {
        // المرسله الموكده
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where('sender_id', $office_id)->where('status', 'received')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
        foreach ($transactions as $transaction) {
            $transaction->currency->currencyName = $transaction->currency->currency->name;
            unset($transaction->currency->currency);
        }
        return response()->json(['success' => 'received Transactions retrived succefull', 'data' => $transactions], 200);
    }
    public function deleteTransactions()
    {
        //طلبات الحذف
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where('receiver_id', $office_id)->where('status', 'delete')->with(['user', 'Reciver', 'Sender', 'currency'])->get();
        foreach ($transactions as $transaction) {
            $transaction->currency->currencyName = $transaction->currency->currency->name;
            unset($transaction->currency->currency);
        }
        return response()->json(['success' => ' Transactions Delete Requests retrived succefull', 'data' => $transactions], 200);
    }
    public function DeleteReq($id)
    {
        //  تاكيد الحذف
        $transaction = Transaction::find($id);
        if ($transaction) {
            if ($transaction->office_type == 'manual') {
                $transaction->delete();
                return response()->json(['message' => "Transaction deleted  Successfully"], 201);
            } else {
                $transaction->update([
                    'status' => "delete",
                ]);
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
                $transaction->delete();
                return response()->json(['success' => "Transaction deleted  Successfully"], 201);
            } else {
                $transaction->update([
                    'status' => "received",
                ]);
                return response()->json(['message' => 'transaction deleted request has been rejected  '], 200);
            }
        } else {
            return response()->json(['failed' => 'transaction not found succefull',], 404);
        }
    }

    public function confirmRecived(Request $request, $id)
    {
        //  االمستلمه للتاكيد و الرفض
        $transactions = Transaction::find($id);
        if ($transactions) {
            $transactions->update([
                'status' => $request->status,
            ]);
            return response()->json(['success' => 'transaction requests retrived succefull', 'data' => $transactions], 200);
        } else {
            return response()->json(['failed' => 'transaction not found '], 404);
        }
    }
}

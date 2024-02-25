<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\TransactionStoreRequest;
use App\Http\Controllers\Controller;
use App\Models\ManualOffice;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Transaction;
use App\Models\TransactionConfirm;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // المستلمه و المرسله
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where(function ($query) use ($office_id) {
            $query->where('sender_id', $office_id)->orWhere('receiver_id', $office_id);
        })->get();
        return response()->json(['success' => 'transactions retrived succefull', 'data' => $transactions], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreRequest $request)
    {
        //
        $Roffice = false;

        $Soffice = Office::where('id', '=', auth()->user()->office_id)->first();
        if ($request->office_type == 'manual') {
            $Roffice = ManualOffice::where('id', '=', $request->receiver_id)->first();
        } else {
            $Roffice = Office::where('id', '=', $request->receiver_id)->first();
        }
        if ($Roffice) {
            if ($Soffice->balance >= intval($request->amount)) {
                $transaction = Transaction::create([
                    'amount' => $request->amount,
                    'sender_id' => $request->sender_id,
                    'receiver_id' => $request->receiver_id,
                    'total_amount' => $request->total_amount,
                    'date' => $request->date,
                    'currency' => $request->currency,
                    'percentage' => $request->percentage,
                    'notes' => $request->notes,
                    // 'status' => $request->status,
                    'type' => $request->type,
                    'office_type' => $request->office_type,
                ]);

                $Soffice->withdraw(intval($request->amount));
                $Roffice = Office::where('id', '=', $request->receiver_id)->first();
                if ($request->office_type != 'manual') {
                    $Roffice->deposit($request->amount);
                }
                return response()->json(['success' => 'transaction add succefull', 'data' => $transaction, 'balance' => $Soffice->balance], 200);
            } else {
                $Soffice = Office::where('id', '=', $request->sender_id)->first();
                return response()->json(['failed' => 'Insufficient balance ', 'balance' => $Soffice->balance], 300);
            }
        } else {
            return response()->json(['failed' => 'Reciver office Not found '], 300);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $transactions = Transaction::where('id', $id)->first();
        if ($transactions) {
            return response()->json(['success' => 'transaction retived succefull', 'data' => $transactions], 200);
        } else {
            return response()->json(['failed' => 'failed to  retived transaction ', 'data' => $transactions], 200);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request =  $request->all();
        $transaction = Transaction::where('id', $id)->first();
        $transactionConfirm = TransactionConfirm::create([
            'amount' => $request['amount'],
            'sender_id' => $request['sender_id'],
            'receiver_id' => $request['receiver_id'],
            'total_amount' => $request['total_amount'],
            'date' => $request['date'],
            'currency' => $request['currency'],
            'percentage' => $request['percentage'],
            'notes' => $request['notes'],
            'status' => $request['status'],
            'type' => $request['type'],
            'action' => $request['action'],
            'office_id' => $request['office_id'],
            'transaction_id' => $transaction['id'],
            'action_status' => 'wait',
        ]);
        if ($transactionConfirm) {
            return response()->json(['message' => "Transaction Request Add Successfully"], 201);
        } else {
            return response()->json(['message' => "Faild to Add Transaction Request  "], 400);
        }
    }



    public function ConfirmUpdate(Request $request, string $id)
    {
        $request =  $request->response;
        $transactionConfirm = TransactionConfirm::where('transaction_id', $id)->first();

       if($transactionConfirm){
        if ($request == 'agreed') {
            $transaction = Transaction::where('id', $id)->update([
                'amount' => $transactionConfirm->amount,
                'sender_id' => $transactionConfirm->sender_id,
                'receiver_id' => $transactionConfirm->receiver_id,
                'total_amount' => $transactionConfirm->total_amount,
                'date' => $transactionConfirm->date,
                'currency' => $transactionConfirm->currency,
                'percentage' => $transactionConfirm->percentage,
                'notes' => $transactionConfirm->notes,
                'status' => 'recived',
                'type' => $transactionConfirm->type,
            ]);
            $transactionConfirm->update([
                'action_status' => 'agreed',
            ]);
            if ($transaction) {
                return response()->json(['message' => "Transaction updated  Successfully", 'transaction' => $transaction], 201);
            }
        } elseif ($request == 'delete') {
            $transactionConfirm->update([
                'action_status' => 'delete',
            ]);

            $transaction = Transaction::find($id);
            $transactionConfirm->delete();
            $transaction->delete();
            return response()->json(['message' => "Transaction deleted  Successfully"], 201);
        } elseif ($request == 'disagreed') {

            $transactionConfirm = TransactionConfirm::where('id', $id)->update(['action_status' => 'disagreed']);
            return response()->json(['message' => "Transaction Action disagreed  Successfully"], 201);
        }
       }
       else{
        return response()->json(['error'=>"No such transaction request found."],404);
       }
    }
    public function transactionsConfirmRequests()
    {
        // طلبات التعديل و الالغاء

        $office_id = auth()->user()->office_id;
        $transactions = TransactionConfirm::where('receiver_id', $office_id)->where('action_status','wait')->get();
        return response()->json(['success' => 'transaction confirm requests retrived succefull', 'data' => $transactions], 200);
    }
    public function recivedTransactions()
    {
        // المستلمه للتاكيد
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where('receiver_id', $office_id)->where('status','send')->get();
        return response()->json(['success' => 'transaction requests retrived succefull', 'data' => $transactions], 200);
    }


    public function sentTransactions()
    {
        // المرسله الموكده
        $office_id = auth()->user()->office_id;
        $transactions = Transaction::where('sender_id', $office_id)->where('status','recived')->get();
        return response()->json(['success' => 'transaction requests retrived succefull', 'data' => $transactions], 200);
    }


    public function confirmRecived(Request $request ,$id)
    {
        //  االمستلمه للتاكيد و الرفض
        $transactions = Transaction::find($id);
        if($transactions){
            $transactions->update([
                'status' => $request->status,
            ]);
        return response()->json(['success' => 'transaction requests retrived succefull', 'data' => $transactions], 200);

        }
        else{
        return response()->json(['failed' => 'transaction not found succefull', 'data' => $transactions], 404);

        }

    }
}

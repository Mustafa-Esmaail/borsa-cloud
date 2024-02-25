<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionConfirmRequest;
use App\Http\Requests\TransactionStoreRequest;
use App\Models\Office;
use App\Models\Transaction;
use App\Models\TransactionConfirm;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($office_id)
    {
        //
        // $office = Office::where('id', '=', $office_id)->first();
        $transactions=Transaction::where(function($query) use($office_id){
            $query->where('sender_id',$office_id)->orWhere('receiver_id',$office_id);
        })->get();
        return response()->json(['success'=>'transaction add succefull','data' => $transactions],200);
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreRequest $request)

    {
        //check balance
        $validated = $request->validated();
        dd($request->all());

        $Soffice = Office::where('id', '=', $request->sender_id)->first();
        if($Soffice->balance >= intval($request->amount)){
            $transaction=Transaction::create([
                'amount' => $request->amount,
                'sender_id' => $request->sender_id,
                'receiver_id' => $request->receiver_id,
                'total_amount' => $request->total_amount,
                'date' => $request->date,
                'currency' => $request->currency,
                'percentage' => $request->percentage,
                'notes' => $request->notes,
                'status'=> $request->status,
                'type'=> $request->type,
            ]);

            $Soffice->withdraw(intval($request->amount));
            $Roffice = Office::where('id', '=', $request->receiver_id)->first();
            $Roffice->deposit($request->amount);

            return response()->json(['success'=>'transaction add succefull','data' => $transaction,'balance'=>$Roffice->balance],200);
        }
        else{
        $Soffice = Office::where('id', '=', $request->sender_id)->first();
            return response()->json(['failed'=>'Insufficient balance ','balance'=>$Soffice->balance],300);
        }





    }

    /**
     * Display the specified resource.
     */
    public function show($transaction)
    {
        //
        $transaction=Transaction::where('id',$transaction)->first();
        return response()->json(['success'=>'transaction retrived ','data' => $transaction],200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function editTransaction(TransactionStoreRequest $request,  $transaction )
    {
        //

        $transaction=Transaction::where('id',$transaction)->first();


            return response()->json(['message'=>$transaction],400);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TransactionConfirmRequest $request, Transaction $transaction)
    {
        //
        $validated = $request->validated();

        $transaction=Transaction::where('id',$transaction)->first();
        dd($transaction);
        $transactionConfirm=TransactionConfirm::create([
            'amount' => $request->amount,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'total_amount' => $request->total_amount,
            'date' => $request->date,
            'currency' => $request->currency,
            'percentage' => $request->percentage,
            'notes' => $request->notes,
            'status'=> $request->status,
            'type'=> $request->type,
            'action'=> $request->action,
            'office_id'=> $request->office_id,
            'transaction_id'=> $transaction->id,
        ]);
        if ($transactionConfirm){
            return response()->json(['message'=>"Transaction Request Add Successfully"],201);
        }
        else{
            return response()->json(['message'=>"Faild to Add Transaction Request  "],400);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}

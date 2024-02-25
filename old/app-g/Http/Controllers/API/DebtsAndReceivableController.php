<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Http\Requests\DebtsAndReceivableStoreRequest;
use App\Http\Requests\DebtsAndReceivableUpdateRequest;
use App\Models\DebtsAndReceivable;
use Illuminate\Http\Request;

class DebtsAndReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $debtsAndReceivable = DebtsAndReceivable::where('office_id',auth()->user()->office_id)->get();
        return response()->json(['success'=>'Debts And Receivable retrived succefull','data' => $debtsAndReceivable]);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(DebtsAndReceivableStoreRequest $request)
    {
        //
        $debtsAndReceivable=DebtsAndReceivable::create([
            'name'  => $request->name,
            'amount'  => $request->amount,
            'type'  => $request->type,
            'currency_id'  => $request->currency_id,
            'office_id'  => $request->office_id,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);
        return response()->json(['success'=>'Debts And Receivable Create succefull','data' => $debtsAndReceivable]);

    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $debtsAndReceivable=DebtsAndReceivable::find($id);
        return response()->json(['success'=>'Debts And Receivable Retrived succefull','data' => $debtsAndReceivable]);
    }
    public function debts()
    {
        //
        $debtsAndReceivable = DebtsAndReceivable::where('office_id',auth()->user()->office_id)->where('type','debt')->get();
        return response()->json(['success'=>'Debts  retrived succefull','data' => $debtsAndReceivable]);
     }
     public function receivables()
     {
         //
         $debtsAndReceivable = DebtsAndReceivable::where('office_id',auth()->user()->office_id)->where('type','receivable')->get();
         return response()->json(['success'=>' Receivables retrived succefull','data' => $debtsAndReceivable]);
      }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(DebtsAndReceivableUpdateRequest $request, string $id)
    {

        $debtsAndReceivable=DebtsAndReceivable::find($id);
        $debtsAndReceivable->update([
            'name'  => $request->name,
            'amount'  => $request->amount,
            'type'  => $request->type,
            'currency_id'  => $request->currency_id,
            'office_id'  => $request->office_id,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);
        return response()->json(['success'=>'Debts And Receivable Updated succefull','data' => $debtsAndReceivable]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $debtsAndReceivable=DebtsAndReceivable::find($id);
        $debtsAndReceivable->delete();
        return response()->json(['success'=>'Debts And Receivable Deleted succefull']);

    }
}

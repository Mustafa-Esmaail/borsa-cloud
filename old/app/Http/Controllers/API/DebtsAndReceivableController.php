<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\DebtsAndReceivableStoreRequest;
use App\Http\Requests\DebtsAndReceivableUpdateRequest;
use App\Models\Currency;
use App\Models\DebtsAndReceivable;
use Illuminate\Http\Request;
use App\Notifications\officeNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\Office;
use App\Models\OfficeCurrency;

class DebtsAndReceivableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $debtsAndReceivable = DebtsAndReceivable::where('office_id', auth()->user()->office_id)->with(['office', 'currency'])->get();
        if($debtsAndReceivable){
            return response()->json(['success' => 'Debts Receivables retrived succefull', 'data' => $debtsAndReceivable],200);
        }
        else{
            return response()->json(['failed' => 'Debts And Receivable not Found'], 404);

        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(DebtsAndReceivableStoreRequest $request)
    {
        //
        $debtsAndReceivable = DebtsAndReceivable::create([
            'name'  => $request->name,
            'amount'  => $request->amount,
            'type'  => $request->type,
            'currency_id'  => $request->currency_id,
            'office_id'  => auth()->user()->office_id,
            'date' => $request->date,
            'notes' => $request->notes,
        ]);
        $S_office=OfficeCurrency::where('office_id', auth()->user()->office_id)->where('currency_id',$request->currency_id)->first();
        if($request->type == 'debt'){
            $S_office->withdraw($request->amount);
        }
        else{
            $S_office->deposit($request->amount);
        }
        return response()->json(['success' => 'Debts And Receivable Create succefull', 'data' => $debtsAndReceivable],200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $debtsAndReceivable = DebtsAndReceivable::where('id', $id)->with(['office', 'currency'])->first();
        if ($debtsAndReceivable) {
            return response()->json(['success' => 'Debts And Receivable Retrived succefull', 'data' => $debtsAndReceivable], 200);
        } else {
            return response()->json(['failed' => 'Debts And Receivable not Found'], 404);
        }
    }
    public function debts()
    {
        //
        $debtsAndReceivable = DebtsAndReceivable::where('office_id', auth()->user()->office_id)->where('type', 'debt')->with(['office', 'currency'])->get();
        if($debtsAndReceivable){
            return response()->json(['success' => ' Receivables retrived succefull', 'data' => $debtsAndReceivable],200);
        }
        else{
            return response()->json(['failed' => 'Receivable not Found'], 404);

        }
    }
    public function receivables()
    {
        //
        $debtsAndReceivable = DebtsAndReceivable::where('office_id', auth()->user()->office_id)->where('type', 'receivable')->with(['office', 'currency'])->get();
        if($debtsAndReceivable){
            return response()->json(['success' => ' Receivables retrived succefull', 'data' => $debtsAndReceivable],200);
        }
        else{
            return response()->json(['failed' => 'Debts  not Found'], 404);

        }

    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(DebtsAndReceivableUpdateRequest $request, string $id)
    {

        $debtsAndReceivable = DebtsAndReceivable::find($id);
        if ($debtsAndReceivable) {
            $debtsAndReceivable->update([
                'name'  => $request->name,
                'amount'  => $request->amount,
                'type'  => $request->type,
                'currency_id'  => $request->currency_id,
                'office_id'  => $request->office_id,
                'date' => $request->date,
                'notes' => $request->notes,
            ]);
            return response()->json(['success' => 'Debts And Receivable Updated succefull', 'data' => $debtsAndReceivable],200);
        } else {
            return response()->json(['failed' => 'Debts And Receivable not Found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $debtsAndReceivable = DebtsAndReceivable::find($id);
        if ($debtsAndReceivable) {
            $debtsAndReceivable->delete();
            return response()->json(['success' => 'Debts And Receivable Deleted succefull'],200);
        } else {
            return response()->json(['failed' => 'Debts And Receivable not Found'], 404);
        }
    }
}

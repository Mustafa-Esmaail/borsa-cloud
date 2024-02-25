<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManualOfficeStoreRequest;
use Illuminate\Http\Request;
use App\Models\ManualOffice;

class ManualOfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $manualOffice=ManualOffice::where('office_id',auth()->user()->office_id)->get();
        return response()->json(['success'=>'Manual Office retrived succefull','Manual office' => $manualOffice]);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //



        // Create Office
        $office = ManualOffice::create([

            'office_name'  => $request->office_name,
            'office_owner'  => $request->office_owner,
            'country'  => $request->country,
            'city'  => $request->city,
            'phone' => $request->phone,
            'office_id' => auth()->user()->office_id,
            'notes' => $request->notes,
        ]);

        // Return response
        return response()->json(['success'=>'Manual Office created succefull','office' => $office]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $transactions = ManualOffice::where('id',$id)->first();
        if($transactions){
            return response()->json(['success' => 'transaction retived succefull', 'data' => $transactions], 200);

        }
        else{
            return response()->json(['failed' => 'failed to  retived transaction ', 'data' => $transactions], 200);

        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

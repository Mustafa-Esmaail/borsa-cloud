<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\OfficeStoreRequest;
use App\Models\Office;
use Illuminate\Http\Request;


class OfficeController extends Controller
{




    public function ApiCreate(OfficeStoreRequest $request)
    {

        $validated = $request->validated();



        // Create Office
        $office = Office::create([

            'office_name'  => $request->office_name,
            'office_owner'  => $request->office_owner,
            'country'  => $request->country,
            'city'  => $request->city,
            'phone' => $request->phone,
        ]);


        // Return response
        return response()->json(['office' => $office], 200);
    }
    public function show(string $id)
    {
        $office = Office::where('id', $id)->with('currencies')->first();
        if( $office){
            return response()->json(['success' => 'office retrived succefull', 'data' => $office],200);
        }
        else{
            return response()->json(['failed' => 'office Not Found ', ],404);
        }
    }
    public function index()
    {
        $offices = Office::all();
         if( $offices){
            return response()->json(['success' => 'offices retrived succefull', 'data' => $offices],200);
        }
        else{
            return response()->json(['failed' => 'offices Not Found ', ],404);
        }
    }
}

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


        $imagePath = $request->file('avatar')->store('office_avatar', 'public');

        // Create Office
        $office = Office::create([

            'office_name'  => $request->office_name,
            'office_owner'  => $request->office_owner,
            'country'  => $request->country,
            'city'  => $request->city,
            'avatar'  => $imagePath,
            'phone' => $request->phone,
        ]);


        // Return response
        return response()->json(['office' => $office]);
    }
    public function show(string $id)
    {




    }
}

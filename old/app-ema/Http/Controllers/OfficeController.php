<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfficeStoreRequest;
use App\Models\Office;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class OfficeController extends Controller
{
    //
    public function index()
    {
        $offices = Office::all();
        return view('office.index', compact('offices'));
    }



    public function store(OfficeStoreRequest $request)
    {
        // Create Office
        $office = Office::create([

            'office_name'  => $request->office_name,
            'office_owner'  => $request->office_owner,
            'country'  => $request->country,
            'city'  => $request->city,
            'phone' => $request->phone,
        ]);

        return redirect()->route('office.index')->with('success', 'office created successfully');
    }


    public function update(OfficeStoreRequest $request, string $id)
    {
        $office=Office::find($id);
        $office->update([
            'office_name'  => $request->office_name,
            'office_owner'  => $request->office_owner,
            'country'  => $request->country,
            'city'  => $request->city,
            'phone' => $request->phone,
        ]);

        return redirect()->route('office.index')->with('success', 'office updated successfully');
    }

    public function destroy($id)
    {
        $office=Office::find($id);
        $office->delete();
        return redirect()->route('office.index')->with('success', 'office deleted successfully');
    }

}

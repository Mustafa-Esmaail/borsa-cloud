<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyStoreRequest;
use App\Http\Requests\CurrencyUpdateRequest;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{

    public function index()
    {
        $currencies = Currency::all();
        return view('currency.index', compact('currencies'));
    }



    public function store(CurrencyStoreRequest $request)
    {
        //
        // Create Office
        $currency = Currency::create([

            'name'  => $request->name,
            'country'  => $request->country,

        ]);

        return redirect()->route('currency.index')->with('success', 'Currency Added successfully');

    }

    public function update(CurrencyUpdateRequest $request, string $id)
    {
        $currency=Currency::find($id);
        $currency->update([
            'name'  => $request->name,
            'country'  => $request->country,
        ]);

        return redirect()->route('currency.index')->with('success', 'Currency updated successfully');
    }

    public function destroy($id)
    {
        $currency=Currency::find($id);
        $currency->delete();
        return redirect()->route('currency.index')->with('success', 'Currency deleted successfully');
    }
}

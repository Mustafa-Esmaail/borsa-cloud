<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCurrencyToOffice;
use App\Http\Requests\CurrencyStoreRequest;
use App\Http\Requests\CurrencyUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\OfficeCurrency;

class CurrencyController extends Controller
{
    //
    public function index()
    {
        $currencies = Currency::all();
        return response()->json(['success' => 'Currencies retrived succefull','currencies'=>$currencies], 200);
    }
    public function offices(){
          $currencies=OfficeCurrency::where('office_id',auth()->user()->office_id)->with('currency')->get();
        if($currencies){
            return response()->json(['success' => 'Currencies retrived succefull','currencies'=>$currencies], 200);

        }
        else{
            return response()->json(['faild' => 'Currencies not  found'], 404);
        }
    }

    public function store(CurrencyStoreRequest $request)
    {
        //
        // Create Currency
        $data=$request->all();

        $currency = Currency::create([

            'name'  => $data['name'],
            'country'  => $data['country'],

        ]);
        if($currency){
            $currencyoffices=OfficeCurrency::create([
                'sell_price'  => $data['sell_price'],
                'buy_price'  => $data['buy_price'],
                'office_id'  => auth()->user()->office_id,
                'currency_id'  => $currency->id,
                'wallet_balance'=>0
            ]);

            if($currencyoffices){
                return response()->json(['success' => 'Currency added succefull','currency'=>$currencyoffices ],200);
            }

        }
        return response()->json(['falied' => 'falied to add Currency '], 405);



    }
    public function AddCurrncyTooffices(AddCurrencyToOffice $request){
        $data=$request->all();

        $currencyoffices=OfficeCurrency::updateOrCreate([
            'sell_price'  => $data['sell_price'],
            'buy_price'  => $data['buy_price'],
            'office_id'  => auth()->user()->office_id,
            'currency_id'  => $data['currency_id'],
            'wallet_balance'=>0
        ]);
                return response()->json(['success' => 'Currency updated succefull'], 200);

    }

    public function update(CurrencyUpdateRequest $request, string $id)
    {

        $currency=OfficeCurrency::where('currency_id',$id)->where('office_id',auth()->user()->office_id)->first();
        if($currency){

        $currency->update([
            'sell_price'  => $request->input('sell_price'),
            'buy_price'  => $request->buy_price,
        ]);

            return response()->json(['success' => 'Currency updated succefull'], 200);
        }
        else{
            return response()->json(['falied' => 'Currency not found '], 404);

        }

    }

    public function destroy($id)
    {
        $currency=OfficeCurrency::where('currency_id',$id)->where('office_id',auth()->user()->office_id)->first();
        if($currency){

        $currency->delete();
        return response()->json(['success' => 'Currency deleted succefull'], 200);
        }
        else{
            return response()->json(['falied' => 'Currency not found '], 404);

        }
    }
}

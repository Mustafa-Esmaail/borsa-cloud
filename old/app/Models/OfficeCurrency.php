<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Stephenjude\Wallet\Interfaces\Wallet;
use Stephenjude\Wallet\Traits\HasWallet;

class OfficeCurrency extends Model implements Wallet
{
    use  SoftDeletes,HasWallet;
    protected $table = 'office_currency';
	public $timestamps = true;


	protected $dates = ['deleted_at'];
	protected $hidden = ['id'];
	protected $fillable = [
        'office_id',
        'currency_id',
        'sell_price',
        'buy_price',
        'wallet_balance',

    ];
    public function currency(){
        return $this->belongsTo(Currency::class,'currency_id');
    }
}

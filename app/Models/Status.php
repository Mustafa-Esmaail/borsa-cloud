<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Status extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'statuses';

    public $timestamps = true;

    protected $casts = [
        'views' => 'array',
    ];
	protected $dates = ['deleted_at','expires_at'];
	protected $fillable = [
        'buy_price',
        'sell_price',
        'expires_at',
        'views',
        'office_id',
        'currency_id',

    ];
    public function office() {
        return $this->belongsTo(Office::class);
    }
    public function currency() {
        return $this->belongsTo(Currency::class);
    }

}

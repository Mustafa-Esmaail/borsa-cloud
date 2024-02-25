<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Stephenjude\Wallet\Interfaces\Wallet;
use Stephenjude\Wallet\Traits\HasWallet;

class ManualOffice extends Model {
    use HasWallet;
	protected $table = 'manual_offices';
	public $timestamps = true;


	protected $dates = ['deleted_at'];
	protected $fillable = [
        'office_name',
        'office_owner',
        'country',
        'city',
        'phone',
        'notes',
        'office_id',
    ];


}

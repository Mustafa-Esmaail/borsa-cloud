<?php

namespace App\Models;

use App\Enums\TransactionsStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'transactions';

    public $timestamps = true;


	protected $dates = ['deleted_at','date'];
	protected $fillable = [
        'amount',
        'sender_id',
        'receiver_id',
        'date',
        'type',
        'currency_id',
        'percentage',
        'total_amount',
        'notes',
        'status',
        'office_type',
        'user_id',

    ];

	public function Sender()
	{
		return $this->belongsTo(Office::class, 'sender_id');
	}
    public function Reciver()
	{
		return $this->belongsTo(Office::class, 'receiver_id');
	}
    public function user()
	{
		return $this->belongsTo(User::class);
	}
    public function currency()
	{
		return $this->belongsTo(OfficeCurrency::class,'currency_id','currency_id');
	}




}

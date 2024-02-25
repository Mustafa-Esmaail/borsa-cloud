<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionConfirm extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'transaction_confirms';

    public $timestamps = true;
	protected $dates = ['deleted_at','date'];
	protected $fillable = [
        'amount',
        'sender_id',
        'receiver_id',
        'sender_name',
        'receiver_name',
        'date',
        'type',
        'currency',
        'percentage',
        'total_amount',
        'notes',
        'status',
        'office_id',
        'transaction_id',
        'action',
        'action_status',
        'user_id',
        'currency_id'


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

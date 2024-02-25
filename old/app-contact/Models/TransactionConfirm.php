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
        'action_status'


    ];

	public function Sender()
	{
		return $this->belongsTo(Office::class, 'sender_id');
	}
    public function Reciver()
	{
		return $this->belongsTo(Office::class, 'reciver_id');
	}
}

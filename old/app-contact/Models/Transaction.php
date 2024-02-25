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
        'currency',
        'percentage',
        'total_amount',
        'notes',
        'status',
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

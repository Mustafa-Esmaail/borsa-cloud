<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Stephenjude\Wallet\Interfaces\Wallet;
use Stephenjude\Wallet\Traits\HasWallet;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model implements Wallet{
    use HasWallet ,SoftDeletes;
	protected $table = 'offices';
	public $timestamps = true;


	protected $dates = ['deleted_at'];
	protected $fillable = [
        'office_name',
        'office_owner',
        'country',
        'city',
        'avatar',
        'phone',
    ];

	public function Converstions()
	{
		return $this->hasMany('Conversation');
	}

	public function users()
	{
		return $this->hasMany(User::class,'office_id');
	}
    public function SentTransactions()
	{
		return $this->hasMany(Transaction::class,'sender_id');
	}
    public function RecivedTransactions()
	{
		return $this->hasMany(Transaction::class,'receiver_id');
	}
    public function contactLists()
	{
		return $this->hasMany(ContactList::class,'office_id');
	}

}

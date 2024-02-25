<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model{
    use SoftDeletes;
	protected $table = 'offices';
	public $timestamps = true;


	protected $dates = ['deleted_at'];
	protected $fillable = [
        'office_name',
        'office_owner',
        'country',
        'city',
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
    public function currencies()
    {
        return $this->belongsToMany(Currency::class, 'office_currency');
    }

}

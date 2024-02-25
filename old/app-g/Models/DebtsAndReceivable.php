<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class DebtsAndReceivable extends Model
{
    use  SoftDeletes;
	protected $table = 'debts_and_receivables';
	public $timestamps = true;


	protected $dates = ['deleted_at','date'];
	protected $fillable = [
        'name',
        'amount',
        'currency_id',
        'office_id',
        'type',
        'city',
        'date',
        'notes',
    ];

    public function office() {
        return $this->belongsTo(Office::class);
    }
    public function currency() {
        return $this->belongsTo(Currency::class);
    }

    // public function getOfficeAttribute()
    // {
    //     return $this->attributes['office_id']->office_name ;
    // }




}

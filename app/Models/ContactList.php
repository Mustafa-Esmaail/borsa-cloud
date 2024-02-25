<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ContactList extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'contact_lists';

    public $timestamps = true;


	protected $dates = ['deleted_at'];
	protected $fillable = [
        'id',
        'office_id',
        'contact_id',
        'status',
        'last_time_message',
        'last_message'

    ];

    public function contactOffices(){
        return  $this->belongsTo(Office::class,'office_id' ,'id');
    }
    public function Offices(){
        return  $this->belongsTo(Office::class,'contact_id' ,'id');
    }
    public function messages(){
        return  $this->belongsTo(Message::class,'contact_id' ,'id');
    }
}

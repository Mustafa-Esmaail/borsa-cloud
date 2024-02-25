<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'contact_id',
         'sender_office_id',
        'received_office_id',
        'last_time_message',
        'text',
        'img',
        'voice',
        'message_type',
       

    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
    public function receiverOffice()
    {
        return $this->belongsTo(Office::class, 'received_office_id');
    }
    public function senderOffice()
    {
        return $this->belongsTo(Office::class, 'sender_office_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHolder extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'transaction_holders';

    public $timestamps = true;


	protected $dates = ['deleted_at'];
	protected $fillable = [
        'id',
        'ID_img',
        'notes',
        'transaction_id',
        'office_id',
        'user_id',

    ];

}

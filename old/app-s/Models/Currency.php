<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use  SoftDeletes;
    protected $table = 'currency';
	public $timestamps = true;


	protected $dates = ['deleted_at'];
	protected $fillable = [
        'name',
        'country',

    ];
    public function offices()
{
    return $this->belongsToMany(Office::class, 'office_currency');
}
}

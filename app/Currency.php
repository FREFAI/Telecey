<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
	protected $table = 'currencies';
	protected $guard = 'admin';
    protected $fillable = [
        'id', 'name', 'code', 'dial_code', 'currency_name', 'currency_symbol', 'currency_code', 'created_at', 'updated_at'
    ];
}

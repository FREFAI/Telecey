<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
	protected $table = 'currencies';

     protected $fillable = [
        'priority', 'iso_code', 'name', 'symbol', 'subunit', 'subunit_to_unit', 'symbol_first', 'html_entity', 'decimal_mark', 'thousands_separator', 'iso_numeric', 'created_at', 'updated_at'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountriesModel extends Model
{
    protected $table = 'countries';
	protected $guard = 'admin';
}

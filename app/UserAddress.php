<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_address';
    protected $fillable = [
        'id', 'user_id', 'address', 'country', 'city', 'postal_code', 'formatted_address', 'is_primary', 'created_at', 'updated_at'
    ];

}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $table = 'devices';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'device_name', 'status', 'created_at', 'updated_at'
    ];
}

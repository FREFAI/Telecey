<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class DeviceColor extends Model
{
    protected $table = 'device_colors';
   	protected $guard = 'admin';

   	protected $fillable = [
        'id', 'color_name', 'is_active', 'created_at', 'updated_at'
   	];
    
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ClassesModel extends Model
{
    protected $table = 'classes';
   	protected $guard = 'admin';

   	protected $fillable = [
        'class_name', 'local_min', 'local_min_start', 'local_min_end', 'data_volume', 'data_volume_start', 'data_volume_end', 'type', 'is_active'
   	];
}

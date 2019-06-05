<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $table = 'service_types';
    protected $guard = 'admin';

    protected $fillable = [
        'service_type_name','type', 'status', 'created_at', 'updated_at'
    ];
}

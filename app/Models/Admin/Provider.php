<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $table = 'providers';
    protected $guard = 'admin';

    protected $fillable = [
        'provider_name','country','provider_image_original','provider_image_resize', 'user_id', 'status', 'created_at', 'updated_at'
    ];
}

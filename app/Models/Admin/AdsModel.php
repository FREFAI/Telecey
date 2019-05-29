<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class AdsModel extends Model
{
    protected $table = 'ads';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'title', 'ads_file', 'script', 'type', 'is_active', 'created_at', 'updated_at'
    ];
}

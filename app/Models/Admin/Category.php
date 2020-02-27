<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
   	protected $guard = 'admin';

   	protected $fillable = [
        'id', 'category_name', 'is_active', 'created_at', 'updated_at'
   	];
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
 	protected $table = 'suppliers';
    protected $guard = 'admin';

    protected $fillable = [
        'supplier_name', 'user_id', 'status', 'created_at', 'updated_at'
    ];
}

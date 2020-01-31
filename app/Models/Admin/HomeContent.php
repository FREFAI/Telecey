<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $table = 'home_contents';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'section_one', 'section_one_image', 'section_two', 'section_three', 'created_at', 'updated_at'
    ];
    
}

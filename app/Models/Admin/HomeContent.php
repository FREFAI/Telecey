<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class HomeContent extends Model
{
    protected $table = 'home_contents';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'section_one', 'section_one_image', 'section_two', 'section_three', 'section_four', 'section_four_image', 'section_four_description', 'section_five','section_six','section_one_image_link','section_four_image_link', 'created_at', 'updated_at'
    ];
    
}

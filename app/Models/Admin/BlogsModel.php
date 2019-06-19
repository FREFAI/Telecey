<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogsModel extends Model
{
    protected $table = 'blogs';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'category_id', 'title', 'blog_content', 'blog_picture','blog_picture_original', 'status', 'created_at', 'updated_at' 
    ];
}

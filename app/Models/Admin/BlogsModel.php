<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BlogsModel extends Model
{
    protected $table = 'blogs';
    protected $guard = 'admin';

    protected $fillable = [
        'id','user_id', 'category_id', 'title', 'blog_content', 'blog_picture','blog_picture_original','image_link', 'status', 'created_at', 'updated_at' 
    ];

    public function category(){
        return $this->hasOne('App\Models\Admin\Category','id', 'category_id');
    }
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }
}

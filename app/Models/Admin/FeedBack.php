<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedBack extends Model
{
    use SoftDeletes; 
    protected $table = 'feed_backs';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'user_id', 'feedback_rating', 'created_at', 'updated_at'
    ];
    public function user(){
        return $this->hasOne('App\User','id', 'user_id');
    }
}

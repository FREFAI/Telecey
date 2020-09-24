<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RatingQuestion extends Model
{
    use SoftDeletes; 
    protected $table = 'rating_questions';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'question', 'type', 'text_field', 'created_at', 'updated_at'
    ];
}

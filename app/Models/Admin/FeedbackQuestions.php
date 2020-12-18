<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeedbackQuestions extends Model
{
    use SoftDeletes; 
    protected $table = 'feedback_questions';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'question_name', 'type', 'created_at', 'updated_at'
    ];
    
}

<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class ServiceRating extends Model
{
    protected $table = 'service_ratings';
    protected $guard = 'customer';

    protected $fillable = [
        'id', 'user_id', 'entity_id', 'entity_type', 'rating_id', 'question_id', 'rating', 'created_at', 'updated_at'
    ];
    
    public function question()
    {
    	return $this->hasOne('App\Models\Admin\RatingQuestion', 'id', 'question_id');
    }
}

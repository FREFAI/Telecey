<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class PlanDeviceRating extends Model
{
    protected $table = 'plan_device_rating';
    protected $guard = 'customer';

    protected $fillable = [
        'id', 'user_id', 'plan_id', 'rating_id', 'comment', 'average', 'user_address_id','created_at', 'updated_at'
    ];

}

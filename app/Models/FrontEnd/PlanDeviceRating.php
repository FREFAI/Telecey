<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class PlanDeviceRating extends Model
{
    protected $table = 'plan_device_rating';
    protected $guard = 'customer';

    protected $fillable = [
        'id', 'user_id', 'plan_id', 'device_id', 'rating_id', 'comment', 'average', 'address', 'country', 'city', 'longitude', 'latitude', 'postal_code', 'formatted_address', 'user_address_id', 'created_at', 'updated_at'
    ];
    public function user_address()
    {
    	return $this->hasOne('App\UserAddress', 'id', 'user_address_id');
    }

    public function plan()
    {
        return $this->hasOne('App\Models\FrontEnd\ServiceReview','id','plan_id');
    }
    public function users()
    {
        return $this->hasOne('App\User','id','user_id');
    }
}

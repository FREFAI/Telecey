<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
	protected $table = 'service_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'user_id', 'provider_name', 'contract_type', 'price', 'payment_type', 'service_type', 'local_min', 'datavolume', 'long_distance_min', 'international_min', 'roaming_min', 'data_speed', 'sms'
    ];
}

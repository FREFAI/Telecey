<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
	protected $table = 'service_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'user_id', 'provider_id', 'contract_type', 'price','currency_id', 'payment_type', 'service_type', 'local_min', 'datavolume', 'long_distance_min', 'international_min', 'roaming_min', 'data_speed', 'sms'
    ];

    public function provider(){
        return $this->hasOne('App\Models\Admin\Provider', 'id', 'provider_id');
    }
}

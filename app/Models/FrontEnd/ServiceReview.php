<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
	protected $table = 'service_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'user_id', 'provider_id', 'contract_type', 'price','currency_id', 'payment_type', 'service_type', 'local_min', 'datavolume', 'long_distance_min', 'international_min', 'roaming_min', 'data_speed', 'sms','voice_price','data_price','overage_price_type'
    ];

    public function provider(){
        return $this->hasOne('App\Models\Admin\Provider', 'id', 'provider_id');
    }
    public function currency(){
        return $this->hasOne('App\Currency', 'id', 'currency_id');
    }
    public function serviceType(){
        return $this->hasOne('App\Models\Admin\ServiceType', 'id', 'service_type');
    }
    public function ratings() {
 	 	  return $this->hasMany('App\Models\FrontEnd\ServiceRating','entity_id','id');
  	}
	  
  	public function get_ratings() {
  		return $this->ratings()->where('entity_type', 1)->get();
  		// return $this->ratings()->where('entity_type', 1)->groupBy('rating_id')->get();
  	}

  	public function plan_device_rating()
  	{
  		return $this->hasMany('App\Models\FrontEnd\PlanDeviceRating','plan_id','id');
  	}
}

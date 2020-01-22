<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class ServiceReview extends Model
{
	protected $table = 'service_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'user_id', 'provider_id', 'contract_type', 'price','brand_id','upfront_price','currency_id', 'payment_type', 'service_type','technology', 'local_min', 'datavolume', 'long_distance_min', 'international_min', 'roaming_min', 'downloading_speed','uploading_speed','speedtest_type', 'sms','latitude','longitude','voice_price','data_price','overage_price_type','voice_usage_price','data_usage_price','pay_as_usage_type','country_code','average_review'
    ];

    public function provider(){
        return $this->hasOne('App\Models\Admin\Provider', 'id', 'provider_id');
    }
    public function currency(){
        return $this->hasOne('App\Currency', 'id', 'currency_id');
    }
    public function typeOfService(){
        return $this->hasOne('App\Models\Admin\ServiceType', 'id', 'service_type');
    }
    public function ratings() {
 	 	  return $this->hasMany('App\Models\FrontEnd\ServiceRating','entity_id','id');
  	}
	  
  	public function get_ratings() {
  		return $this->ratings()->where('entity_type', 1)->orderBy('created_at','DESC')->get();
  		// return $this->ratings()->where('entity_type', 1)->groupBy('rating_id')->get();
  	}
    public function brand() {
        return $this->hasOne('App\Models\Admin\Brands','id','brand_id');
    }
  	public function plan_device_rating()
  	{
        return $this->hasMany('App\Models\FrontEnd\PlanDeviceRating','plan_id','id');
    }
    
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    public function plan_rating()
  	{
        return $this->hasOne('App\Models\FrontEnd\PlanDeviceRating','plan_id','id');
    }
}

<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;
use App\Models\Admin\Provider;
use App\Models\Admin\ServiceType;
use App\Currency;

class ServiceReview extends Model
{
	protected $table = 'service_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'user_id', 'provider_id', 'contract_type', 'price','brand_id','upfront_price','currency_id', 'payment_type', 'service_type','technology', 'local_min', 'datavolume', 'long_distance_min', 'international_min', 'roaming_min', 'downloading_speed','uploading_speed','speedtest_type', 'sms','latitude','longitude','voice_price','speed','data_price','overage_price_type','voice_usage_price','data_usage_price','pay_as_usage_type','country_code','average_review'
    ];
    protected $appends = [
        'providers_detail',
        'service_type_detail',
        'currency_detail'
    ];
    public function provider(){
        return $this->hasOne('App\Models\Admin\Provider', 'id', 'provider_id');
    }
    public function getProvidersDetailAttribute()
    {
        return Provider::select('id','provider_name','provider_image_original','provider_image_resize')->where('id',$this->attributes['provider_id'])->first();
    }
    public function getServiceTypeDetailAttribute()
    {
        return ServiceType::where('id',$this->attributes['service_type'])->first();
    }
    public function getCurrencyDetailAttribute()
    {
        return Currency::where('id',$this->attributes['currency_id'])->first();
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
	  
  	public function get_ratings($id) {
          $ratings = $this->ratings()->where('entity_id', $id)->where('entity_type', 1)->orderBy('created_at','DESC')->get();
          return $ratings;
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

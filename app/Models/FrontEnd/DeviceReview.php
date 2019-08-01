<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class DeviceReview extends Model
{
    protected $table = 'device_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'id', 'user_id', 'device_id', 'brand_id', 'model_id', 'price', 'currency_id', 'storage', 'created_at', 'updated_at'
    ];

 	  public function device(){
        return $this->hasOne('App\Models\Admin\Devices', 'id', 'device_id');
    }
    public function currency(){
        return $this->hasOne('App\Currency', 'id', 'currency_id');
    }
    public function brand(){
        return $this->hasOne('App\Models\Admin\Brands', 'id', 'brand_id');
    }
    public function model(){
        return $this->hasOne('App\Models\Admin\BrandModels', 'id', 'model_id');
    }
    public function ratings() {
 	 	  return $this->hasMany('App\Models\FrontEnd\ServiceRating','entity_id','id');
  	}
	  
  	public function get_ratings() {
  		return $this->ratings()->where('entity_type', 2)->orderBy('created_at','DESC')->get();
  		// return $this->ratings()->where('entity_type', 1)->groupBy('rating_id')->get();
  	}
  	public function plan_device_rating()
  	{
  		return $this->hasMany('App\Models\FrontEnd\PlanDeviceRating','device_id','id');
  	}
}

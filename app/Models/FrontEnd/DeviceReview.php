<?php

namespace App\Models\FrontEnd;

use Illuminate\Database\Eloquent\Model;

class DeviceReview extends Model
{
    protected $table = 'device_reviews';
    protected $guard = 'customer';

    protected $fillable = [
        'id', 'user_id', 'device_id', 'brand_id', 'supplier_id','device_color', 'price', 'currency_id', 'storage', 'latitude','longitude','country_code','average_review','created_at', 'updated_at'
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
    public function supplier(){
        return $this->hasOne('App\Models\Admin\Supplier', 'id', 'supplier_id');
    }
    public function device_color_info(){
        return $this->hasOne('App\Models\Admin\DeviceColor', 'id', 'device_color');
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
    public function user()
    {
        return $this->hasOne('App\User','id','user_id');
    }
    public function device_rating()
    {
        return $this->hasOne('App\Models\FrontEnd\PlanDeviceRating','device_id','id');
    }
}

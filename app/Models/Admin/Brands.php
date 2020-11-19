<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
   	protected $guard = 'admin';

   	protected $fillable = [
       'id', 'brand_name','model_name','device_type','colors_id','user_id','default','status', 'created_at', 'updated_at'
   	];

   	public function brandModels(){
   		return $this->hasMany('App\Models\Admin\BrandModels','brand_id', 'id');
   	}
   	public function device(){
   		return $this->hasOne('App\Models\Admin\Devices','id', 'device_type');
   	}
}

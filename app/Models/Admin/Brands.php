<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    protected $table = 'brands';
   	protected $guard = 'admin';

   	protected $fillable = [
       'id', 'brand_name','model_name','user_id','default','status', 'created_at', 'updated_at'
   	];

   	public function brandModels(){
   		return $this->hasMany('App\Models\Admin\BrandModels','brand_id', 'id');
   	}
}

<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class BrandModels extends Model
{
  	protected $table = 'brand_models';
    protected $guard = 'admin';

    protected $fillable = [
        'id', 'brand_id', 'model_name', 'status', 'created_at', 'updated_at' 
    ];


   	public function brand(){
   		return $this->belongsTo('App\Models\Admin\Brands','brand_id', 'id');
   	}
}

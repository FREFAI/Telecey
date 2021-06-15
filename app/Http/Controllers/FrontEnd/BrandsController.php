<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\BrandModels;
use App\Models\Admin\Brands;
use App\Models\Admin\DeviceColor;

class BrandsController extends Controller
{

	/**
	 * Get brand colors of perticular brand 
	 */
	public function getBrandColor(Request $request)
	{
		$perameter = $request->all();
		$models = Brands::find($perameter['id']);
		if($models){
			$ids = explode(',',$models->colors_id);
			$colors = DeviceColor::whereIn('id',$ids)->get();
			return json_encode(array('success'=>true,'message'=>'','data'=>$colors));
		}else{
			return json_encode(array('success'=>false,'message'=>__('index.Brand is not found'),'data'=>'{}'));
		}
	}

}

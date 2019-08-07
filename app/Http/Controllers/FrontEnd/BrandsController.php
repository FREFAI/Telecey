<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\BrandModels;

class BrandsController extends Controller
{
    public function getModels(Request $request)
    {
    	$perameter = $request->all();
    	$validation = Validator::make($perameter, [
    	    'brand_id' => 'required'
    	]);
    	if ( $validation->fails() ) {
    	     $message = array('success'=>false,'message'=>$validation->messages()->first(),'data'=>'{}');
    	     return json_encode($message);
    	}else{
    		$models = BrandModels::where('brand_id',$perameter['brand_id'])->select('id','model_name','brand_id')->get()->toArray();
    		// $models = json_encode($models);
    		$message = array('success'=>true,'message'=>'','data'=>$models);
	     	return json_encode($message);
    	}
    }
}

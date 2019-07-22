<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\DeviceReview;
use Auth;

class DeviceReviewController extends Controller
{
    public function reviewDevice(Request $request)
    {
    	$user_id = Auth::guard('customer')->user()['id']; 
    	$perameter = $request->all();
    	$validation = Validator::make($perameter, [
    	    'device_id' => 'required',
			'brand_id' => 'required',
			'price' => 'required',
			'model_id' => 'required',
			'storage' => 'required'
    	]);
    	if ( $validation->fails() ) {
    	     $message = array('success'=>false,'message'=>$validation->messages()->first());
    	     return json_encode($message);
    	}else{
    		$perameter['user_id'] = $user_id;
    		if($deviceReview = DeviceReview::create($perameter)){
    			$message = array('success'=>false,'message'=>'Device review add successfully.','data'=>$deviceReview);
    			return json_encode($message);
    		}
    	}
    }
}

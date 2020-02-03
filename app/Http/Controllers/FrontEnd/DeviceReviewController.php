<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\DeviceReview;
use App\Models\FrontEnd\PlanDeviceRating;
use App\Models\FrontEnd\ServiceRating;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\RatingQuestion;
use App\Models\Admin\Supplier;
use App\Models\Admin\Brands;
use App\UserAddress;
use Auth;

class DeviceReviewController extends Controller
{
    public function reviewDevice(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        $userAddress = UserAddress::select('country')->where('user_id',$user_id)->where('is_primary',1)->first();
        if($userAddress){
            $country = $userAddress->country;
        }else{
            $country=null;
        }
        $perameter = $request->all();
    	$validation = Validator::make($perameter, [
    	    'device_id' => 'required',
			'brand_id' => 'required',
			'price' => 'required',
			// 'supplier_id' => 'required',
			'storage' => 'required'
    	]);
    	if ( $validation->fails() ) {
    	     $message = array('success'=>false,'message'=>$validation->messages()->first());
    	     return json_encode($message);
    	}else{
            if($perameter['brand_status'] == 2){
                $brandData = [
                    'brand_name' => $perameter['brand_id'],
                    'model_name' => $perameter['model_name'],
                    'status' => 0,
                    'user_id' => $user_id
                ];
                $brandvalidation = Validator::make($brandData, [
                    'brand_name' => 'required',
                    'model_name' => 'required'
                ]);
                if ( $brandvalidation->fails() ) {
                     $message = array('success'=>false,'message'=>$brandvalidation->messages()->first());
                     return json_encode($message);
                }else{
                    if($brands = Brands::create($brandData)){
                        $perameter['brand_id'] = $brands->id;
                    }else{
                        $message = array('success'=>false,'message'=>'Add new brands error!');
                        return json_encode($message);
                    }
                }
            }
            if($perameter['supplier_status'] == 2){
                $supplierData = [
                    'supplier_name' => $perameter['supplier_id'],
                    'country' => $country,
                    'status' => 0,
                    'user_id' => $user_id
                ];
                $suppliervalidation = Validator::make($supplierData, [
                    'supplier_name' => 'required'
                ]);
                if ( $suppliervalidation->fails() ) {
                     $message = array('success'=>false,'message'=>$suppliervalidation->messages()->first());
                     return json_encode($message);
                }else{
                    if($supplier = Supplier::create($supplierData)){
                        $perameter['supplier_id'] = $supplier->id;
                    }else{
                        $message = array('success'=>false,'message'=>'Add new brands error!');
                        return json_encode($message);
                    }
                }
            }
            $perameter['user_id'] = $user_id;
            $ip = env('ip_address','live');
            if($ip == 'live'){
                $ip = $_SERVER['REMOTE_ADDR'];
            }else{
                $ip = '96.46.34.142';
            }
            $client = new \GuzzleHttp\Client();
            $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey").'&ip='.$ip);
            $newresponse = json_decode($newresponse->getBody());
            $perameter['country_code'] = $newresponse->country_code2;
            
    		if($deviceReview = DeviceReview::create($perameter)){
    			$message = array('success'=>true,'message'=>'Device review add successfully.','device_id'=>$deviceReview->id);
    			return json_encode($message);
    		}
    	}
    }

    public function ratingDevice(Request $request)
    {
        $input = $request->all();
        
        $user_id = Auth::guard('customer')->user()['id'];
        $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('device_id',$input['device_id'])->max('rating_id');
        $rating_id = $rating_id+1;
        if(array_key_exists('user_country', $input)){
            if($input['user_country'] != ""){
                if($input['user_address_id'] == 0 && $input['is_primary'] == 1){
                    UserAddress::where('user_id',$user_id)->update(['is_primary'=>0]);
                    $is_primary = 1;
                }else{
                    $is_primary = 0;
                }
                $insertAddress = [
                    'user_id' => $user_id,
                    'address' =>$input['user_full_address'],
                    'country' =>$input['user_country'],
                    'city' =>$input['user_city'],
                    'postal_code' => $input['user_postal_code'],
                    'formatted_address' => $input['formatted_address'],
                    'is_primary' => $is_primary
                ];
                $newAddress = UserAddress::create($insertAddress);
                if($newAddress){
                    $input['user_address_id'] = $newAddress->id;
                }
            }
        }else{
          $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
          if($userAddress){
              $input['user_address_id'] = $userAddress->id;
          }else{
            $input['user_address_id']=NULL;
          }
        }

        $perameters=[
            'user_id' => $user_id,
            'device_id' => $input['device_id'],
            'rating_id'=> $rating_id,
            'comment'=> $input['comment'],
            'average' => $input['average_input'],
            'user_address_id' => $input['user_address_id']
        ];
        $validation = Validator::make($perameters, [
            'user_id' => 'required',
            'device_id' => 'required',
            'average' => 'required',
            'user_address_id' => 'required'
        ]);
        if ( $validation->fails() ) {
             $message = array('success'=>false,'message'=>$validation->messages()->first());
             return json_encode($message);
        }else{
            $date = date("Y-m-d H:i:s");
            $data = [];
            $plandevicerating = PlanDeviceRating::create($perameters);
            if($plandevicerating){
                foreach ($input['perameters'] as $value) {
                    $dataInsert = [
                        'user_id'=>$user_id,
                        'entity_id'=>$plandevicerating->device_id,
                        'entity_type'=>2,
                        'rating_id'=>$plandevicerating->rating_id,
                        'question_id'=>$value['question_id'],
                        'rating'=>$value['rate'],
                        'text_field_value'=>$value['text_field_value'], 
                        'created_at'=>$date,
                        'updated_at'=>$date
                    ];
                    array_push($data, $dataInsert);
                }
                $serviceRating = ServiceRating::insert($data);
                $sum = 0;
                $average = 0;
                $plan_device_rating_count = PlanDeviceRating::where('device_id',$plandevicerating->device_id)->count();
                $plan_device_rating = PlanDeviceRating::where('device_id',$plandevicerating->device_id)->pluck('average');
                foreach($plan_device_rating as $key => $value){
                    $sum = $sum + $value; 
                }
                if($plan_device_rating_count == 0){
                    $average = $sum;
                }else{
                    $average = $sum/$plan_device_rating_count;
                }
                DeviceReview::where('id',$plandevicerating->device_id)->update(['average_review' => $average]);
                if($serviceRating){
                    $message = array('success'=>true,'message'=>'Successfully submited.');
                    return json_encode($message);
                }else{
                    $message = array('success'=>false,'message'=>"Somthing went wrong!");
                    return json_encode($message);
                }
            }else{
                $message = array('success'=>false,'message'=>"Somthing went wrong!");
                return json_encode($message);
            }
        }
    }

    public function deviceReviewsRating(Request $request, $device_id)
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        $pageType = $device_id;
        $device_id = base64_decode($device_id);
        $ip = env('ip_address','live');
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            // $ip = '2606:4580:2:0:a974:e358:829c:412e';
            $ip = '122.173.214.129';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey").'&ip='.$ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;

        $settings = SettingsModel::first();
        $questions = RatingQuestion::Where('type',2)->get();
        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
        return view('FrontEnd.reviews_rating',['settings'=> $settings,'device_id'=>$device_id,'questions'=>$questions,'userAddress'=>$userAddress,'type'=>2,'lat' =>  $current_lat,'long'=>$current_long]);
    }
}

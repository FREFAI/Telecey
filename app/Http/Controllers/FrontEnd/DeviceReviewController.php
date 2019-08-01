<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\DeviceReview;
use App\Models\FrontEnd\PlanDeviceRating;
use App\Models\FrontEnd\ServiceRating;
use App\UserAddress;
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
                        'created_at'=>$date,
                        'updated_at'=>$date
                    ];
                    array_push($data, $dataInsert);
                }
                $serviceRating = ServiceRating::insert($data);
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
}

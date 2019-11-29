<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\FrontEnd\PlanDeviceRating;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\ServiceRating;
use App\Models\Admin\RatingQuestion;
use App\Helpers\GenerateNickName;
use App\Models\Admin\ServiceType;
use App\Models\Admin\Provider;
use Illuminate\Http\Request;
use App\CountriesModel;
use App\UserAddress;
use App\Currency;
use App\User;
use DB, Excel, Auth;

class IndependentController extends Controller
{
   
    public function addNikNameIfNotExist()
    {
      $users = User::get();
      
      foreach($users as $user){
        if($user->nickname == ""){
          $nickname = GenerateNickName::nickName($user->firstname);
          $user->nickname = $nickname;
          $user->save();
        } 
      }
      return json_encode(array('success'=>true));
    }



    public function importPlanRecordExcelFile(Request $request)
    {
      $input = $request->all();
    	$validation = Validator::make($input,[
        'excelFile' => 'required|mimes:xls,xlsx',
        'user_id' => 'required'
    	]);
    	if ($validation->fails()) {
        $message = array('success'=>false,'message'=>$validation->messages()->first());
        return json_encode($message);
    	}else{
        $path = $request->file('excelFile')->getRealPath();
        $data = Excel::load($path)->get()[0];
        $user_id = $input['user_id'];
        // $allData = [];
        if($data->count() > 0 ){
          foreach($data->toArray() as $key => $value)
            {
              DB::beginTransaction();
              try {
                // Add Provider If Not Exist
                $provider = Provider::where('provider_name',$value['provider'])->first();
                if($provider){
                  $provider_id = $provider->id;
                }else{
                  $dataInsertProvider = [
                    'provider_name' => $value['provider'],
                    'country' => ucfirst(strtolower($value['country'])),
                    'user_id' => 0,
                    'status' => 1
                  ];
                  $newProvider = Provider::create($dataInsertProvider);
                  $provider_id = $newProvider->id;
                }
                $value['contrcat_type'] = preg_replace('/\s/', '',$value['contrcat_type']);
                $contract_type = $value['contrcat_type'] == "personal" ? 1 : 2;
                // Add Service Type if not exist
                $service_type = ServiceType::where('service_type_name',$value['service_type'])->first();
                if($service_type){
                  $service_type_id = $service_type->id;
                }else{
                  $dataInsertServiceType = [
                    'service_type_name' => $value['service_type'],
                    'status' => 1,
                    'type' => $contract_type
                  ];
                  $newServiceType = ServiceType::create($dataInsertServiceType);
                  $service_type_id = $newServiceType->id;
                }


                $currency = Currency::where('name',$value['country'])->first();
                if($currency){
                  $currency_id = $currency->id;
                }else{
                  $currency_id = NULL;
                }
                $countries = CountriesModel::where('name',$value['country'])->first();
                if($countries){
                  $countries_code = $countries->code;
                }else{
                  $countries_code = NULL;
                }
                
                $planReviewDataInsert = [
                  'user_id' => $user_id,
                  'provider_id' => $provider_id ,
                  'contract_type' => $contract_type,
                  'price' => $value['price'],
                  'currency_id' => $currency_id,
                  'payment_type' => strtolower($value['paymnet_type']),
                  'service_type' => $service_type_id,
                  'technology' => $value['technology'],
                  'local_min' => 100,
                  'datavolume' => $value['data_volume'],
                  'long_distance_min' => 'Unlimited',
                  'international_min' => 0,
                  'roaming_min' => 0,
                  'downloading_speed' => 0,
                  'uploading_speed' => 0,
                  'speedtest_type' => 0,
                  'sms' => 'Unlimited',
                  'average_review' => $value['average_rate'],
                  'country_code' => $countries_code
                ];
                $allData[] =  $value;
                $addedPlan = ServiceReview::create($planReviewDataInsert);
                
                $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('plan_id',$addedPlan->id)->max('rating_id');
                $rating_id = $rating_id+1;
                $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
                if($userAddress){
                    $input['user_address_id'] = $userAddress->id;
                }else{
                  $input['user_address_id']=NULL;
                }

                $perameters=[
                    'user_id' => $user_id,
                    'plan_id' => $addedPlan->id,
                    'rating_id'=> $rating_id,
                    'comment'=> NULL,
                    'average' => 5,
                    'user_address_id' => $input['user_address_id']
                ];
                $validation = Validator::make($perameters, [
                    'user_id' => 'required',
                    'plan_id' => 'required',
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
                      $questions = RatingQuestion::Where('type',1)->get();
                        foreach ($questions as $question) {
                            $dataInsert = [
                                'user_id'=>$user_id,
                                'entity_id'=>$plandevicerating->plan_id,
                                'entity_type'=>1,
                                'rating_id'=>$plandevicerating->rating_id,
                                'question_id'=>$question->id,
                                'rating'=>5,
                                'text_field_value'=>NULL,
                                'created_at'=>$date,
                                'updated_at'=>$date
                            ];
                            array_push($data, $dataInsert);
                        }
                        $serviceRating = ServiceRating::insert($data);
                        $average = 5;
                        ServiceReview::where('id',$plandevicerating->plan_id)->update(['average_review' => $average]);  
                    }
                }
                DB::commit();
                print_r($value);
                echo "  Done <br>";
              }catch (\Exception $e) {
                echo "  Not Done <br>";
                print_r($value);
                echo "Data Not Added";
                print_r($e);
                echo "<br>";
                DB::rollback();
                  // something went wrong
              }
          }
        }
        return $allData;
      }
    }
    public function test(Type $var = null)
    {
      
      $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('plan_id',$input['service_id'])->max('rating_id');
      $rating_id = $rating_id+1;
      $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
      if($userAddress){
          $input['user_address_id'] = $userAddress->id;
      }else{
        $input['user_address_id']=NULL;
      }

      $perameters=[
          'user_id' => $user_id,
          'plan_id' => $input['service_id'],
          'rating_id'=> $rating_id,
          'comment'=> NULL,
          'average' => 5,
          'user_address_id' => $input['user_address_id']
      ];
      $validation = Validator::make($perameters, [
          'user_id' => 'required',
          'plan_id' => 'required',
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
            $questions = RatingQuestion::Where('type',1)->get();
              foreach ($questions as $value) {
                  $dataInsert = [
                      'user_id'=>$user_id,
                      'entity_id'=>$plandevicerating->plan_id,
                      'entity_type'=>1,
                      'rating_id'=>$plandevicerating->rating_id,
                      'question_id'=>$questions->id,
                      'rating'=>5,
                      'text_field_value'=>NULL,
                      'created_at'=>$date,
                      'updated_at'=>$date
                  ];
                  array_push($data, $dataInsert);
              }
              $serviceRating = ServiceRating::insert($data);
              $average = 5;
              ServiceReview::where('id',$plandevicerating->plan_id)->update(['average_review' => $average]);
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
    public function ratingService(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::guard('customer')->user()['id'];
        if($input['type'] == 1){
            $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('plan_id',$input['service_id'])->max('rating_id');
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
                        'latitude' => $input['latitude'],
                        'longitude' => $input['longitude'],
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
                'plan_id' => $input['service_id'],
                'rating_id'=> $rating_id,
                'comment'=> $input['comment'],
                'average' => $input['average_input'],
                'user_address_id' => $input['user_address_id']
            ];
            $validation = Validator::make($perameters, [
                'user_id' => 'required',
                'plan_id' => 'required',
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
                            'entity_id'=>$plandevicerating->plan_id,
                            'entity_type'=>1,
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
                    // save average in service_reviews table
                    $sum = 0;
                    $average = 0;
                    $plan_device_rating_count = PlanDeviceRating::where('plan_id',$plandevicerating->plan_id)->count();
                    $plan_device_rating = PlanDeviceRating::where('plan_id',$plandevicerating->plan_id)->pluck('average');
                    foreach($plan_device_rating as $key => $value){
                        $sum = $sum + $value; 
                    }
                    if($plan_device_rating_count == 0){
                        $average = $sum;
                    }else{
                        $average = $sum/$plan_device_rating_count;
                    }
                    ServiceReview::where('id',$plandevicerating->plan_id)->update(['average_review' => $average]);
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
        }else{
            $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('device_id',$input['service_id'])->max('rating_id');
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
                'device_id' => $input['service_id'],
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
}

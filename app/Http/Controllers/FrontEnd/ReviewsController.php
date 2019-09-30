<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use Illuminate\Support\Facades\Validator;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\ServiceRating;
use App\Models\FrontEnd\PlanDeviceRating;
use App\Models\Admin\Provider;
use App\Models\Admin\ServiceType;
use App\Models\Admin\RatingQuestion;
use App\Models\Admin\BrandModels;
use App\Models\Admin\Devices;
use App\Models\Admin\Brands;
use App\Models\Admin\Supplier;
use App\User;
use App\UserAddress;
use App\Currency;
use App\CountriesModel;
use Auth;

class ReviewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $settings = SettingsModel::first();
        view()->composer('layouts/frontend_layouts/header', function($view) use ($settings) {
            $view->with('settings', $settings);
        });
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function reviews(Request $request)
    {
        $perameters = $request->all();
        
        
        $user_id = Auth::guard('customer')->user()['id']; 
        if (!$request->session()->has('usersDetail')) {
            $ip = env('ip_address','live');
            if($ip == 'live'){
                $ip = $_SERVER['REMOTE_ADDR'];
            }else{
                // $ip = '2606:4580:2:0:a974:e358:829c:412e';
                $ip = '122.173.214.129';
            }
            // $ip = '96.46.34.142';
            $data = \Location::get($ip);
            $current_lat = $data->latitude;
            $current_long = $data->longitude;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&latlng='.$data->latitude.','.$data->longitude);
            $response = json_decode($response->getBody());
            $storableLocation = [];
            $data = [];
            $k = 0;
            $localitydata = $response->results[0]->address_components;
            foreach ($localitydata as $value) {
                $types = $value->types;
                if(in_array('locality', $types)) {
                    $storableLocation['city'] = $value->long_name;
                }
                if (in_array('administrative_area_level_1', $types)) {
                    $storableLocation['state']= $value->long_name;
                }
                if (in_array('country', $types)) {
                    $storableLocation['country'] = $value->long_name;
                    $storableLocation['country_code'] = $value->short_name;
                }
                if (in_array('postal_code', $types)) {
                    $storableLocation['postal_code'] = $value->long_name;
                }

            }
            
            $request->session()->put('usersDetail', $storableLocation); 
        }
        $usersDetailSession = $request->session()->get('usersDetail');
        $usersDetail = User::find($user_id); 
        $usersAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first(); 
        if(!$usersAddress){
            if(array_key_exists('country', $usersDetailSession)){
                $usersDetail->country = $usersDetailSession['country'];
                $usersDetail->country_code = $usersDetailSession['country_code'];
            }else{
                $usersDetail->country = null;
                $usersDetail->country_code =$usersDetailSession['country_code'];
            }
            if(array_key_exists('city', $usersDetailSession)){
                $usersDetail->city = $usersDetailSession['city'];
            }else{
                $usersDetail->city = null;
            }
            if(array_key_exists('postal_code', $usersDetailSession)){
                $usersDetail->postal_code = $usersDetailSession['postal_code'];
            }else{
                $usersDetail->postal_code = null;
            }
        }else{
            $countrycode = CountriesModel::where('name',$usersAddress->country)->first();
            if($countrycode){
                $usersDetail->country = $usersAddress->country;
                $usersDetail->country_code = $countrycode->code;
            }else{
                $usersDetail->country = $usersAddress->country;
                $usersDetail->country_code = 'CA';
            }
            $usersDetail->city = $usersAddress->city;
            $usersDetail->postal_code = $usersAddress->postal_code;

        }
        $ip = env('ip_address','live');
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            // $ip = '2606:4580:2:0:a974:e358:829c:412e';
            $ip = '122.173.214.129';
        }
        // $ip = '96.46.34.142';
        $data = \Location::get($ip);
        $current_lat = $data->latitude;
        $current_long = $data->longitude;
        $settings = SettingsModel::first();
        $providers = Provider::get();
        $countries = Currency::get();
        $brandModels = BrandModels::get();
        $devices = Devices::get();
        $brands = Brands::get();
        $suppliers = Supplier::get();
        $service_types = ServiceType::get();
        $questions = RatingQuestion::get();

        return view('FrontEnd.reviews',['settings'=> $settings,'usersDetail'=>$usersDetail,'providers'=>$providers,'service_types'=>$service_types,'countries'=>$countries,'questions'=>$questions,'userAddress'=>$usersAddress,'brandModels'=>$brandModels,'brands'=>$brands,'devices'=>$devices,'suppliers'=>$suppliers,'lat' =>  $current_lat,'long'=>$current_long]);
    }
    public function reviewsRating(Request $request, $plan_id)
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        $pageType = $plan_id;
        $plan_id = base64_decode($plan_id);
        $settings = SettingsModel::first();
        $questions = RatingQuestion::Where('type',1)->get();
        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
        return view('FrontEnd.reviews_rating',['settings'=> $settings,'plan_id'=>$plan_id,'questions'=>$questions,'userAddress'=>$userAddress,'type'=>1]);
    }
    public function reviewsDetail(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::guard('customer')->user()['id']; 
        $user_address_id = Auth::guard('customer')->user()['user_address_id'];
        $validation = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        if ( $validation->fails() ) {
             $message = array('success'=>false,'message'=>$validation->messages()->first());
             return json_encode($message);
        }else{
            $userUpdate = [
                'firstname'=>$input['firstname'],
                'lastname'=>$input['lastname'],
                'mobile_number'=>$input['mobile_number'],
            ];
            $user = User::where('id',$user_id)->update($userUpdate);
            if($user){
                $user_address = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
                if($user_address){
                    $formatted = $input['city'].' '.$input['country'].' '.$input['postal_code'];
                    $user_address->city = $input['city'];
                    $user_address->country = $input['country'];
                    $user_address->postal_code = $input['postal_code'];
                    $user_address->formatted_address = $formatted;
                    $user_address->latitude = $input['latitude'];
                    $user_address->longitude = $input['longitude'];
                    if($user_address->save()){
                        $message = array('success'=>true,'message'=>'Updated successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>"Somthing went wrong in user address!");
                        return json_encode($message);
                    }
                    
                }else{
                    $formatted = $input['city'].' '.$input['country'].' '.$input['postal_code'];
                    $address=[
                        'user_id'=>$user_id,
                        'formatted_address'=>$formatted,
                        'city'=> $input['city'],
                        'country'=> $input['country'],
                        'postal_code'=> $input['postal_code'],
                        'latitude'=> $input['latitude'],
                        'longitude'=> $input['longitude'],
                        'is_primary'=>1
                    ];
                    UserAddress::create($address);
                    $message = array('success'=>true,'message'=>'Add new address successfully.');
                    return json_encode($message);
                }
            }else{
                    $message = array('success'=>false,'message'=>"User not update successfully.");
                    return json_encode($message);
            }
        }
    }
    public function reviewService(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $input = $request->all();
        if(!array_key_exists('overage_price', $input)){
            $input['overage_price_type'] = 0;
            $input['data_price'] = NULL;
            $input['voice_price'] = NULL;

        }else{
            $input['overage_price_type'] = 1;
        }
        
        if(!array_key_exists('contract_type', $input)){
            $input['contract_type'] = "1";
        }
        if(!array_key_exists('payment_type', $input)){
            $input['payment_type'] = "postpaid";
        }else{
            $input['payment_type'] = "prepaid";
        }
        $validation = Validator::make($input, [
            'provider_id' => 'required',
            'service_type' => 'required',
            'local_min' => 'required',
            'datavolume' => 'required',
        ]);
        if ( $validation->fails() ) {
             $message = array('success'=>false,'message'=>$validation->messages()->first());
             return json_encode($message);
        }else{
            if($input['provider_status'] == 2){
                $providerData = [
                    'provider_name' => $input['provider_id'],
                    'status' => 0,
                    'user_id' => $user_id
                ];
                $providervalidation = Validator::make($providerData, [
                    'provider_name' => 'required|unique:providers',
                ]);
                if ( $providervalidation->fails() ) {
                     $message = array('success'=>false,'message'=>$providervalidation->messages()->first());
                     return json_encode($message);
                }else{
                    if($provider = Provider::create($providerData)){
                        $input['provider_id'] = $provider->id;
                    }else{
                        $message = array('success'=>false,'message'=>'Add new provider error!');
                        return json_encode($message);
                    }
                }
            }
            $input['user_id'] = $user_id;
            if(!array_key_exists('pay_as_usage_type', $input)){
                $input['pay_as_usage_type'] = 0;
                $input['voice_usage_price'] = NULL;
                $input['data_usage_price'] = NULL;

            }else{
                $input['pay_as_usage_type'] = 1;
                $input['datavolume'] = NULL;
                $input['local_min'] = NULL;
                $input['long_distance_min'] = NULL;
                $input['international_min'] = NULL;
                $input['roaming_min'] = NULL;
                $input['sms'] = NULL;
            }
            $ip = env('ip_address','live');
            if($ip == 'live'){
                $ip = $_SERVER['REMOTE_ADDR'];
            }else{
                $ip = '96.46.34.142';
            }
            $data = \Location::get($ip);
            $input['country_code'] = $data->countryCode;
            $serviceReview = ServiceReview::create($input);
            if($serviceReview){
                $message = array('success'=>true,'message'=>'Add successfully.','service_id'=>$serviceReview->id);
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>"Somthing went wrong!");
                return json_encode($message);
            }
        }
    }

    public function saveSpeedTest(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'downloading_speed' => 'required',
            'uploading_speed' => 'required',
            'plan_id' => 'required',
            'speedtest_type' => 'required',
        ]);
        if ( $validation->fails() ) {
             $message = array('success'=>false,'message'=>$validation->messages()->first());
             return json_encode($message);
        }else{
            $review = ServiceReview::find($input['plan_id']);
            if($review){
                $review->downloading_speed = $input['downloading_speed'];
                $review->uploading_speed = $input['uploading_speed'];
                $review->speedtest_type = $input['speedtest_type'];
                if($review->save()){
                    $message = array('success'=>true,'message'=>'Speed testing saved.');
                    return json_encode($message);
                }else{
                    $message = array('success'=>false,'message'=>'Somthing went wrong!');
                    return json_encode($message);
                }
            }else{
                $message = array('success'=>false,'message'=>'Service review not found!');
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
    public function getCountry(Request $request)
    {

        $perameters = $request->all();
        $countries = CountriesModel::orderBy('name','DESC')->where('name', 'LIKE', '%'. $perameters['search']. '%')->select('name','code')->get();
        if(count($countries)>0){
            $message = array('success'=>true,'data'=>$countries);
            return json_encode($message);
        }else{
            $message = array('success'=>false,'message'=>"Somthing went wrong!");
            return json_encode($message);
        }
    }
}

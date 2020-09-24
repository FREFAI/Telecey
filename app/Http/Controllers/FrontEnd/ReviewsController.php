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
use App\Models\FrontEnd\DeviceReview;
use App\Models\Admin\RatingQuestion;
use App\Models\Admin\BrandModels;
use App\Models\Admin\Devices;
use App\Models\Admin\Brands;
use App\Models\Admin\Supplier;
use App\Models\Admin\DeviceColor;
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
        $ip = env('ip_address','live');
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            // $ip = '2606:4580:2:0:a974:e358:829c:412e';
            $ip = '96.46.34.142';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey").'&ip='.$ip);
        $newresponse = json_decode($newresponse->getBody());
        
        // echo "<pre>";
        // print_r($newresponse);
        // exit;
        // if (!$request->session()->has('usersDetail')) {
            // $ip = '96.46.34.142';
            $current_lat = $newresponse->latitude;
            $current_long = $newresponse->longitude;
            $storableLocation['city'] = $newresponse->city;
            $storableLocation['state'] = $newresponse->state_prov;
            $storableLocation['country'] = $newresponse->country_name;
            $storableLocation['country_code'] = $newresponse->country_code2;
            $storableLocation['postal_code'] = $newresponse->zipcode;
            
            $request->session()->put('usersDetail', $storableLocation); 
        // }
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
                $usersDetail->user_city = null;
            }else{
                $usersDetail->city = null;
                $usersDetail->user_city = null;
            }
            if(array_key_exists('postal_code', $usersDetailSession)){
                $usersDetail->postal_code = $usersDetailSession['postal_code'];
                $usersDetail->user_postal_code = null;
            }else{
                $usersDetail->postal_code = null;
                $usersDetail->user_postal_code = null;
            }
        }else{
            $countrycode = CountriesModel::where('name',$usersAddress->country)->first();
            if($countrycode){
                $usersDetail->country = $usersAddress->country;
                $usersDetail->country_code = $countrycode->code;
            }else{
                $usersDetail->country = $usersAddress->country;
                $usersDetail->country_code = $usersAddress->country_code;
            }
            $usersDetail->city = $usersAddress->city;
            $usersDetail->user_city = $usersAddress->user_city;
            $usersDetail->user_postal_code = $usersAddress->user_postal_code;
            $usersDetail->postal_code = $usersAddress->postal_code;

        }
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;
        $settings = SettingsModel::first();
        $providers = Provider::where('country',$usersDetail->country)->get();
       
        $countries = Currency::get();
        $brandModels = BrandModels::get();
        $devices = Devices::get();
        $brands = Brands::get();
        $suppliers = Supplier::where('country',$usersDetail->country)->get();
        $service_types = ServiceType::get();
        $questions = RatingQuestion::get();
        $colors = DeviceColor::get();
        return view('FrontEnd.reviews',['settings'=> $settings,'usersDetail'=>$usersDetail,'providers'=>$providers,'service_types'=>$service_types,'countries'=>$countries,'questions'=>$questions,'userAddress'=>$usersAddress,'brandModels'=>$brandModels,'brands'=>$brands,'devices'=>$devices,'suppliers'=>$suppliers,'lat' =>  $current_lat,'long'=>$current_long,'colors'=>$colors]);
    }
    public function reviewsRating(Request $request, $lang,$plan_id)
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        $pageType = $plan_id;
        $ip = env('ip_address','live');
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            // $ip = '2606:4580:2:0:a974:e358:829c:412e';
            $ip = '96.46.34.142';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey").'&ip='.$ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;

        $plan_id = base64_decode($plan_id);
        $settings = SettingsModel::first();
        $questions = RatingQuestion::Where('type',1)->get();
        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
        return view('FrontEnd.reviews_rating',['settings'=> $settings,'plan_id'=>$plan_id,'questions'=>$questions,'userAddress'=>$userAddress,'type'=>1,'lat' =>  $current_lat,'long'=>$current_long]);
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
                    $formatted = $user_address->address.''.$input['city'].' '.$input['country'].' '.$input['postal_code'];
                    $user_address->city = $input['city'];
                    $user_address->country = $input['country'];
                    $user_address->postal_code = $input['postal_code'];
                    $user_address->country_code = $input['country_code'];
                    $user_address->formatted_address = $formatted;
                    $user_address->latitude = $input['latitude'];
                    $user_address->longitude = $input['longitude'];
                    if($user_address->save()){
                        $message = array('success'=>true,'message'=>__('index.Updated successfully'),'address' => $formatted);
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>__("index.Somthing went wrong"));
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
                        'country_code'=> $input['country_code'],
                        'latitude'=> $input['latitude'],
                        'longitude'=> $input['longitude'],
                        'is_primary'=>1
                    ];
                    UserAddress::create($address);
                    $message = array('success'=>true,'message'=>__('index.Add new address successfully'),'address' => $formatted);
                    return json_encode($message);
                }
            }else{
                    $message = array('success'=>false,'message'=>__("index.User not update successfully"));
                    return json_encode($message);
            }
        }
    }
    public function reviewService(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $userAddress = UserAddress::select('country')->where('user_id',$user_id)->where('is_primary',1)->first();
        if($userAddress){
            $country = $userAddress->country;
        }else{
            $country=null;
        }
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
                    'country' => $country,
                    'status' => 0,
                    'user_id' => $user_id
                ];
                $provider = Provider::where('provider_name',$input['provider_id'])->first();
                if($provider){
                    $input['provider_id'] = $provider->id;
                }else{
                    if($provider = Provider::create($providerData)){
                        $input['provider_id'] = $provider->id;
                    }else{
                        $message = array('success'=>false,'message'=>__('index.Add new provider error'));
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
            $client = new \GuzzleHttp\Client();
            $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey").'&ip='.$ip);
            $newresponse = json_decode($newresponse->getBody());
            $input['country_code'] = $newresponse->country_code2;
            if($input['plan_id'] == ""){
                $serviceReview = ServiceReview::create($input);
                $plan_id = $serviceReview->id;
            }else{
                unset($input['provider_status']);
                $plan_id = $input['plan_id'];
                unset($input['plan_id']);
                unset($input['overage_price']);
                $serviceReview = ServiceReview::where('id',$plan_id)->update($input);
            }
            if($serviceReview){
                $message = array('success'=>true,'message'=>__('index.Add successfully'),'service_id'=>$plan_id);
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
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
                    $message = array('success'=>true,'message'=>__('index.Speed testing saved'));
                    return json_encode($message);
                }else{
                    $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
                    return json_encode($message);
                }
            }else{
                $message = array('success'=>false,'message'=>__('index.Service review not found'));
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
                        $insertAddress = [
                            'latitude' => $input['latitude'],
                            'longitude' => $input['longitude'],
                            'address' =>$input['user_full_address'],
                            'country' =>$input['user_country'],
                            'country_code' =>$input['user_country_code'],
                            'city' =>$input['user_city'],
                            'postal_code' => $input['user_postal_code'],
                            'formatted_address' => $input['formatted_address']
                        ];
                        UserAddress::where('user_id',$user_id)->where('is_primary',1)->update($insertAddress);
                    }
                }else{
                    $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
                    if($userAddress){
                        $input['user_full_address'] = $userAddress->address;
                        $input['user_country'] = $userAddress->country;
                        $input['user_city'] = $userAddress->user_city;
                        $input['longitude']= $userAddress->longitude;
                        $input['latitude'] = $userAddress->latitude;
                        $input['user_postal_code'] = $userAddress->postal_code;
                        $input['formatted_address'] = $userAddress->formatted_address;
                    }else{
                        $input['user_full_address'] =NULL;
                        $input['user_country']=NULL;
                        $input['user_city'] =NULL;
                        $input['longitude'] =NULL;
                        $input['latitude'] =NULL;
                        $input['user_postal_code'] =NULL;
                        $input['formatted_address'] =NULL;
                    }
                }
            }else{
              $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
              if($userAddress){
                $input['user_full_address'] = $userAddress->address;
                $input['user_country'] = $userAddress->country;
                $input['user_city'] = $userAddress->user_city;
                $input['longitude']= $userAddress->longitude;
                $input['latitude'] = $userAddress->latitude;
                $input['user_postal_code'] = $userAddress->postal_code;
                $input['formatted_address'] = $userAddress->formatted_address;
              }else{
                $input['user_full_address'] =NULL;
                $input['user_country']=NULL;
                $input['user_city'] =NULL;
                $input['longitude'] =NULL;
                $input['latitude'] =NULL;
                $input['user_postal_code'] =NULL;
                $input['formatted_address'] =NULL;
              }
            }

            $perameters=[
                'user_id' => $user_id,
                'plan_id' => $input['service_id'],
                'rating_id'=> $rating_id,
                'comment'=> $input['comment'],
                'average' => $input['average_input'],
                'latitude' => $input['latitude'],
                'longitude' => $input['longitude'],
                'address' =>$input['user_full_address'],
                'country' =>$input['user_country'],
                'city' =>$input['user_city'],
                'postal_code' => $input['user_postal_code'],
                'formatted_address' => $input['formatted_address']
            ];
            $validation = Validator::make($perameters, [
                'user_id' => 'required',
                'plan_id' => 'required',
                'average' => 'required'
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
                        $message = array('success'=>true,'message'=>__('index.Successfully submited'));
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
                        return json_encode($message);
                    }
                }else{
                    $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
                    return json_encode($message);
                }
            }
        }else{
            $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('device_id',$input['service_id'])->max('rating_id');
            $rating_id = $rating_id+1;
            if(array_key_exists('user_country', $input)){
                if($input['user_country'] != ""){
                    if($input['user_address_id'] == 0 && $input['is_primary'] == 1){
                        $insertAddress = [
                            'latitude' => $input['latitude'],
                            'longitude' => $input['longitude'],
                            'address' =>$input['user_full_address'],
                            'country' =>$input['user_country'],
                            'country_code' =>$input['user_country_code'],
                            'city' =>$input['user_city'],
                            'postal_code' => $input['user_postal_code'],
                            'formatted_address' => $input['formatted_address']
                        ];
                        UserAddress::where('user_id',$user_id)->where('is_primary',1)->update($insertAddress);
                    }
                }else{
                    $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
                    if($userAddress){
                        $input['user_full_address'] = $userAddress->address;
                        $input['user_country'] = $userAddress->country;
                        $input['user_city'] = $userAddress->city;
                        $input['longitude']= $userAddress->longitude;
                        $input['latitude'] = $userAddress->latitude;
                        $input['user_postal_code'] = $userAddress->postal_code;
                        $input['formatted_address'] = $userAddress->formatted_address;
                    }else{
                        $input['user_full_address'] =NULL;
                        $input['user_country']=NULL;
                        $input['user_city'] =NULL;
                        $input['longitude'] =NULL;
                        $input['latitude'] =NULL;
                        $input['user_postal_code'] =NULL;
                        $input['formatted_address'] =NULL;
                    }
                }
            }else{
                $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
                if($userAddress){
                    $input['user_full_address'] = $userAddress->address;
                    $input['user_country'] = $userAddress->country;
                    $input['user_city'] = $userAddress->city;
                    $input['longitude']= $userAddress->longitude;
                    $input['latitude'] = $userAddress->latitude;
                    $input['user_postal_code'] = $userAddress->postal_code;
                    $input['formatted_address'] = $userAddress->formatted_address;
                }else{
                    $input['user_full_address'] =NULL;
                    $input['user_country']=NULL;
                    $input['user_city'] =NULL;
                    $input['longitude'] =NULL;
                    $input['latitude'] =NULL;
                    $input['user_postal_code'] =NULL;
                    $input['formatted_address'] =NULL;
                }
            
            }
            $perameters=[
                'user_id' => $user_id,
                'device_id' => $input['service_id'],
                'rating_id'=> $rating_id,
                'comment'=> $input['comment'],
                'average' => $input['average_input'],
                'latitude' => $input['latitude'],
                'longitude' => $input['longitude'],
                'address' =>$input['user_full_address'],
                'country' =>$input['user_country'],
                'city' =>$input['user_city'],
                'postal_code' => $input['user_postal_code'],
                'formatted_address' => $input['formatted_address']
            ];
            $validation = Validator::make($perameters, [
                'user_id' => 'required',
                'device_id' => 'required',
                'average' => 'required',
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
                        $message = array('success'=>true,'message'=>__('index.Successfully submited'));
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
                        return json_encode($message);
                    }
                }else{
                    $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
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
            $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
            return json_encode($message);
        }
    }
}

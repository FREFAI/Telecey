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
use App\User;
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
        if($usersDetail->country == ""){
            if(array_key_exists('country', $usersDetailSession)){
                $usersDetail->country = $usersDetailSession['country'];
                $usersDetail->country_code = $usersDetailSession['country_code'];
            }else{
                $usersDetail->country = null;
                $usersDetail->country_code =$usersDetailSession['country_code'];
            }
        }else{
            $countrycode = CountriesModel::where('name',$usersDetail->country)->first();
            if($countrycode){
                $usersDetail->country_code = $countrycode->code;
            }else{
                $usersDetail->country_code = 'CA';
            }

        }
        if($usersDetail->city == ""){
            if(array_key_exists('city', $usersDetailSession)){
                $usersDetail->city = $usersDetailSession['city'];
            }else{
                $usersDetail->city = null;
            }
        }
        if($usersDetail->postal_code == ""){
            if(array_key_exists('postal_code', $usersDetailSession)){
                $usersDetail->postal_code = $usersDetailSession['postal_code'];
            }else{
                $usersDetail->postal_code = null;
            }
        }
        // echo "<pre>";
        // print_r($usersDetail);
        // exit;
        $settings = SettingsModel::first();
        $providers = Provider::get();
        $countries = Currency::get();
        $service_types = ServiceType::get();
        $questions = RatingQuestion::Where('type',1)->get();

        return view('FrontEnd.reviews',['settings'=> $settings,'usersDetail'=>$usersDetail,'providers'=>$providers,'service_types'=>$service_types,'countries'=>$countries,'questions'=>$questions]);
    }
    public function reviewsRating(Request $request, $plan_id)
    {
        $plan_id = base64_decode($plan_id);
        $settings = SettingsModel::first();
        $questions = RatingQuestion::Where('type',1)->get();
        return view('FrontEnd.reviews_rating',['settings'=> $settings,'plan_id'=>$plan_id,'questions'=>$questions]);
    }
    public function reviewsDetail(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::guard('customer')->user()['id']; 
        $validation = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        if ( $validation->fails() ) {
             $message = array('success'=>false,'message'=>$validation->messages()->first());
             return json_encode($message);
        }else{
            $user = User::where('id',$user_id)->update($input);
            if($user){
                $message = array('success'=>true,'message'=>'Updated successfully.');
                return json_encode($message);
         }else{
            $message = array('success'=>false,'message'=>"Somthing went wrong!");
            return json_encode($message);
         }
        }
    }
    public function reviewService(Request $request)
    {
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
                    'status' => 0
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
            $user_id = Auth::guard('customer')->user()['id'];
            $input['user_id'] = $user_id;
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

    public function ratingService(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::guard('customer')->user()['id'];
        $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('plan_id',$input['plan_id'])->max('rating_id');
        $rating_id = $rating_id+1;
        $perameters=[
            'user_id' => $user_id,
            'plan_id' => $input['plan_id'],
            'rating_id'=> $rating_id,
            'comment'=> $input['comment'],
            'average' => $input['average_input']
        ];
        $validation = Validator::make($perameters, [
            'user_id' => 'required',
            'plan_id' => 'required',
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
        // exit;
        

        // $input['user_id'] = $user_id;
        // $serviceRating = ServiceRating::create($input);
        // if($serviceRating){
        //     $message = array('success'=>true,'message'=>'Successfully submited.');
        //     return json_encode($message);
        // }else{
        //     $message = array('success'=>false,'message'=>"Somthing went wrong!");
        //     return json_encode($message);
        // }
        
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

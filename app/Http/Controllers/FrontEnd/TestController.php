<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\AdsModel;
use App\Models\Admin\ServiceType;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\PlanDeviceRating;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\RatingQuestion;
use App\UserAddress;
use App\CountriesModel;
use App\Helpers\CreateLogs;
use DB;


class TestController extends Controller
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
    public function plansResult(Request $request)
    {   
        $data=$request->all();
        // Current location section
        $ip = env('ip_address','live'); 
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip = '14.99.89.178';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey").'&ip='.$ip);
        $newresponse = json_decode($newresponse->getBody());
        
        $current_location = $newresponse->country_name.','.$newresponse->state_prov.','.$newresponse->city.','.$newresponse->zipcode;
        $current_lat = 30.704649; 
        $current_long = 76.717873;
        // $current_lat = array_key_exists("lat",$data) && $data['lat'] != "" ? $data['lat']  : $newresponse->latitude;
        // $current_long = array_key_exists("lng",$data) && $data['lng'] != "" ? $data['lng']  : $newresponse->longitude;
        $current_country_code = $newresponse->country_code2;
        $filtersetting = SettingsModel::first();
        if(!Auth::guard('customer')->check()){
                $limit = $filtersetting->no_of_search_record ? $filtersetting->no_of_search_record : 20;
        }else{
            if(array_key_exists("rows",$data)){
                $limit = $data['rows'];
            }else{
                $limit = 20;
            } 
        }
        $country = CountriesModel::select('id')->where('name',$newresponse->country_name)->first();
        $ads = AdsModel::with('countries')
                            ->where('is_active',1)
                            ->where(function ($query) use ($country) {
                                $query->where('is_global',1)
                                ->orWhere('country',$country->id);
                            })->get()->toArray();
        $googleads = AdsModel::where('type',1)->first();
        $user = Auth::guard('customer')->user();
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        if(count($data)>1){
            $filter = 1;
            if(array_key_exists("filter",$data)){
                $filter = $data['filter'];
            }
            $filterParams = [
                "current_country_code" => $current_country_code
            ];
            $mainQuery = PlanDeviceRating::query();
            $mainQuery->leftJoin('service_reviews', 'plan_device_rating.plan_id', '=', 'service_reviews.id');
            $mainQuery->leftJoin('providers', 'providers.id', '=', 'service_reviews.provider_id');
            $mainQuery->leftJoin('users', 'users.id', '=', 'plan_device_rating.user_id');
            // $mainQuery->select('plan_device_rating.longitude','plan_device_rating.latitude','service_reviews.price','service_reviews.local_min');
            $mainQuery->select(DB::raw('( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( plan_device_rating.latitude ) ) * cos( radians( plan_device_rating.longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( plan_device_rating.latitude ) ) ) ) AS distance'),'plan_device_rating.plan_id as id','plan_device_rating.longitude','plan_device_rating.latitude','service_reviews.price','service_reviews.local_min','providers.provider_image_original','providers.provider_name','providers.provider_image_resize','providers.status','service_reviews.provider_id','plan_device_rating.average','users.is_active','service_reviews.datavolume','service_reviews.average_review');
            $mainQuery->orderBy('distance','ASC')
                ->where('plan_device_rating.plan_id','!=',0);
            $mainQuery->where('service_reviews.country_code',$filterParams['current_country_code']);
            if(array_key_exists("service_type",$data) && $data['service_type'] != ""){
                $mainQuery->orWhere('service_reviews.service_type',$data['service_type']);
            }
            if(!array_key_exists("min_type",$data)){
                if(array_key_exists("local_min",$data)){
                    $mainQuery->orWhere('service_reviews.local_min',$data['local_min']);
                }
            }
            if(array_key_exists("datavolume",$data) && $data['datavolume'] != ""){
                $mainQuery->orWhere('service_reviews.datavolume',$data['datavolume']);
            }
            if(array_key_exists("contract_type",$data) && $data['contract_type'] != ""){
                $mainQuery->orWhere('service_reviews.contract_type',$data['contract_type']);
            }else{
                $mainQuery->orWhere('service_reviews.contract_type',1);
            }
            if(array_key_exists("payment_type",$data) && $data['payment_type'] != ""){
                $mainQuery->orWhere('service_reviews.payment_type',$data['payment_type']);
            }else{
                $mainQuery->orWhere('service_reviews.payment_type','postpaid');
            }
            if(array_key_exists("pay_as_usage_type",$data)){
                $mainQuery->orWhere('service_reviews.pay_as_usage_type',$data['pay_as_usage_type']);
            }
            $mainQuery->whereNotNull('plan_device_rating.longitude')->whereNotNull('plan_device_rating.latitude');
            $searchResultCount = $mainQuery->count();
            $searchResult = $mainQuery->groupBy('plan_device_rating.plan_id')->paginate($limit);
            // echo "<pre>"; print_r($searchResult->toArray()); exit;
        }else{
            $searchResult = [];
            $filter = 1;
        }
        return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'googleads'=>$googleads,'service_types' => $service_types,'data' => $searchResult,'filterType' => $filter]);

    }
    public function plansResultSorting(Request $request)
    {
        $params = $request->all();
        $requestData = explode('&',$params['requestParams']);
        $data = [];
        foreach($requestData as $rd){
           $param = explode('=',$rd);
           $data[str_replace('?','',$param[0])] = $param[1];
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
        $current_location = $newresponse->country_name.','.$newresponse->state_prov.','.$newresponse->city.','.$newresponse->zipcode;
       
        $current_lat = array_key_exists("lat",$data) && $data['lat'] != "" ? $data['lat']  : $newresponse->latitude;
        $current_long = array_key_exists("lng",$data) && $data['lng'] != "" ? $data['lng']  : $newresponse->longitude;
        $current_country_code = $newresponse->country_code2;
        $filtersetting = SettingsModel::first();
        if(!Auth::guard('customer')->check()){
            $limit = $filtersetting->no_of_search_record ? $filtersetting->no_of_search_record : 20;
        }else{
            $limit = 20;
        }
        $user = Auth::guard('customer')->user();
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        $filter = 1;
        if(array_key_exists("filter",$data)){
            $filter = $data['filter'];
        }
        $country = CountriesModel::select('id')->where('name',$newresponse->country_name)->first();
        $ads = AdsModel::with('countries')
                            ->where('is_active',1)
                            ->where(function ($query) use ($country) {
                                $query->where('is_global',1)
                                ->orWhere('country',$country->id);
                            })->get()->toArray();
        $googleads = AdsModel::where('type',1)->first();
        $filterParams = [
            "current_country_code" => $current_country_code
        ];
        $mainQuery = PlanDeviceRating::query();
        $mainQuery->leftJoin('service_reviews', 'plan_device_rating.plan_id', '=', 'service_reviews.id');
        $mainQuery->leftJoin('providers', 'providers.id', '=', 'service_reviews.provider_id');
        $mainQuery->leftJoin('users', 'users.id', '=', 'plan_device_rating.user_id');
        // $mainQuery->select('plan_device_rating.longitude','plan_device_rating.latitude','service_reviews.price','service_reviews.local_min');
        $mainQuery->select(DB::raw('( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( plan_device_rating.latitude ) ) * cos( radians( plan_device_rating.longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( plan_device_rating.latitude ) ) ) ) AS distance'),'plan_device_rating.plan_id as id','plan_device_rating.longitude','plan_device_rating.latitude','service_reviews.price','service_reviews.local_min','providers.provider_image_original','providers.provider_name','providers.provider_image_resize','providers.status','service_reviews.provider_id','plan_device_rating.average','users.is_active','service_reviews.datavolume','service_reviews.average_review');
        $mainQuery
            ->where('plan_device_rating.plan_id','!=',0);
        $mainQuery->where('service_reviews.country_code',$filterParams['current_country_code']);
        if(array_key_exists("service_type",$data) && $data['service_type'] != ""){
            $mainQuery->orWhere('service_reviews.service_type',$data['service_type']);
        }
        if(!array_key_exists("min_type",$data)){
            if(array_key_exists("local_min",$data)){
                $mainQuery->orWhere('service_reviews.local_min',$data['local_min']);
            }
        }
        if(array_key_exists("datavolume",$data) && $data['datavolume'] != ""){
            $mainQuery->orWhere('service_reviews.datavolume',$data['datavolume']);
        }
        if(array_key_exists("contract_type",$data) && $data['contract_type'] != ""){
            $mainQuery->orWhere('service_reviews.contract_type',$data['contract_type']);
        }else{
            $mainQuery->orWhere('service_reviews.contract_type',1);
        }
        if(array_key_exists("payment_type",$data) && $data['payment_type'] != ""){
            $mainQuery->orWhere('service_reviews.payment_type',$data['payment_type']);
        }else{
            $mainQuery->orWhere('service_reviews.payment_type','postpaid');
        }
        if(array_key_exists("pay_as_usage_type",$data)){
            $mainQuery->orWhere('service_reviews.pay_as_usage_type',$data['pay_as_usage_type']);
        }
        $mainQuery->whereNotNull('plan_device_rating.longitude')->whereNotNull('plan_device_rating.latitude');
        if($params['name'] != "distance"){
            $mainQuery->orderBy('service_reviews.'.$params['name'],$params['sort']);
        }else{
            $mainQuery->orderBy('distance',$params['sort']);
        }
        $searchResultCount = $mainQuery->count();
        $searchResult = $mainQuery->groupBy('plan_device_rating.plan_id')->paginate($limit);
        foreach($searchResult as $key => $value){
            $user_address = '';
            $sum = 0;
            $average = 0;
            $user_address = UserAddress::where('user_id',$searchResult[$key]['user_id'])->where('is_primary',1)->value('formatted_address');
            $searchResult[$key]['user_address'] = $user_address;
        }
        return view('FrontEnd.plans.planSorting',['data' => $searchResult,'filtersetting'=>$filtersetting,'ads'=>$ads,'googleads'=>$googleads]);
    }
}
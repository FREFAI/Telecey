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
use App\UserAddress;
use App\CountriesModel;
use App\Helpers\CreateLogs;
use DB;


class PlansController extends Controller
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
    public function plans(Request $request)
    {
        // Current location section
        $ip = env('ip_address','live'); 
        $ip = '96.46.34.142';
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $location = \Location::get($ip);
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&latlng='.$location->latitude.','.$location->longitude);
        $response = json_decode($response->getBody());
        $current_location = $response->results[0]->formatted_address;
        $current_lat = $location->latitude;
        $current_long = $location->longitude;
        $current_country_code = $location->countryCode;
        $filtersetting = SettingsModel::first();
        if(!Auth::guard('customer')->check()){
            $limit = $filtersetting->no_of_search_record ? $filtersetting->no_of_search_record : 20;
        }else{
            $limit = 20;
        }
        if($filtersetting->ads_setting == 0){
            $ads = AdsModel::where('type',0)->get();
        }else{
            $ads = AdsModel::where('type',1)->first();
        }
        $user = Auth::guard('customer')->user();
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        
        $data=$request->all();
        if(count($data)>1){
            $contract_type="";
            $payment_type="";
            $pay_as_usage_type="";
            $service_type= "";
            $filter = 1;
            $user_id = Auth::guard('customer')->id();
            if(array_key_exists("contract_type",$data)){
                $contract_type = $data['contract_type'];
            }elseif(array_key_exists("payment_type",$data)){
                $payment_type = $data['payment_type'];
            }elseif(array_key_exists("pay_as_usage_type",$data)){
                $pay_as_usage_type = $data['pay_as_usage_type'];
            }elseif(array_key_exists("service_type",$data)){
                $service_type = $data['service_type'];
            }elseif(array_key_exists("filter",$data)){
                $filter = $data['filter'];
            }
            
            $searchResultCount = ServiceReview::select(DB::raw('*, ( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('country_code',$current_country_code)->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                $query->orWhere('contract_type',$contract_type)
                ->orWhere('payment_type',$payment_type)
                ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                ->orWhere('service_type',$service_type);
                    })->with('provider','currency','typeOfService')
                    ->orderBy('distance','ASC')
                    ->orderBy('local_min','DESC')
                    ->orderBy('datavolume','DESC')
                    ->orderBy('price','ASC')
                    ->orderBy('average_review','DESC')
                    ->count();

            $searchResult = ServiceReview::select(DB::raw('*, ( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                ->where('country_code',$current_country_code)->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                    $query->orWhere('contract_type',$contract_type)
                    ->orWhere('payment_type',$payment_type)
                    ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                    ->orWhere('service_type',$service_type);
                        })->with('provider','currency','typeOfService')
                        ->orderBy('distance','ASC')
                        ->orderBy('local_min','DESC')
                        ->orderBy('datavolume','DESC')
                        ->orderBy('price','ASC')
                        ->orderBy('average_review','DESC')
                        ->paginate($limit);
                foreach($searchResult as $key => $value){
                    $user_address = '';
                    $sum = 0;
                    $average = 0;
                    $user_address = UserAddress::where('user_id',$searchResult[$key]['user_id'])->where('is_primary',1)->value('formatted_address');
                    $searchResult[$key]['user_address'] = $user_address;
                }
                if($user_id){
                    $logData = [
                        'user_id'                       => $user->id,
                        'log_type'                      => 5,
                        'type'                          => 2,
                        'filter_type'                   => 1,
                        'user_status'                   => $user->is_active,
                        'user_name'                     => $user->firstname.' '.$user->lastname,
                        'user_number'                   => $user->mobile_number,
                        'email'                         => $user->email,
                        'filter_params'                 => json_encode($data),
                        'filter_search_result_count'    => $searchResultCount
                    ];
                }else{
                    $logData = [
                        'log_type'                      => 5,
                        'type'                          => 2,
                        'filter_type'                   => 1,
                        'ip'                            => $ip,
                        'filter_params'                 => json_encode($data),
                        'filter_search_result_count'    => $searchResultCount
                    ];
                }
                
                CreateLogs::createLog($logData);
            return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'service_types' => $service_types,'data' => $searchResult,'filterType' => $filter]);

        }else{
            $searchResult = ServiceReview::select(DB::raw('*, ( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('country_code',$current_country_code)
            ->with('provider','currency','typeOfService')
                    ->orderBy('distance','ASC')
                    ->orderBy('local_min','DESC')
                    ->orderBy('datavolume','DESC')
                    ->orderBy('price','ASC')
                    ->orderBy('average_review','DESC')
                    ->paginate($limit);
            return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'data'=>$searchResult,'service_types' => $service_types,]);
        }               
        
    }
    public function plansNew(Request $request)
    {
        // Current location section
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
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;
        $current_country_code = $newresponse->country_code2;
        $filtersetting = SettingsModel::first();
        $limit = 3;
        
        $user = Auth::guard('customer')->user();
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        $country = CountriesModel::select('id')->where('name',$newresponse->country_name)->first();
        // $ads = AdsModel::with('countries')->where('is_global',1)->orWhere('country',$country->id)->get();
        $data=$request->all();
        $searchResult = ServiceReview::select(DB::raw('*, ( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
        ->where('country_code',$current_country_code)
        ->with('provider','currency','typeOfService','user','ratings','plan_rating')
        ->orderBy('distance','ASC')
        ->paginate($limit);
        return view('FrontEnd.plansNew',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'data'=>$searchResult,'service_types' => $service_types,]);               
        
    }

    public function plansResult(Request $request)
    {
        $data=$request->all();
        // Current location section
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
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;
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
            $mainQuery = ServiceReview::query();
            $mainQuery->select(DB::raw('*, ( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('country_code',$current_country_code)
            ->with('provider','currency','typeOfService');
            $mainQuery->where(function ($query) use ($data) {
                if(array_key_exists("service_type",$data) && $data['service_type'] != ""){
                    $query->orWhere('service_type',$data['service_type']);
                }
                if(!array_key_exists("min_type",$data)){
                    $query->orWhere('local_min',$data['local_min']);
                }
                if(array_key_exists("datavolume",$data) && $data['datavolume'] != ""){
                    $query->orWhere('datavolume',$data['datavolume']);
                }
                if(array_key_exists("contract_type",$data) && $data['contract_type'] != ""){
                    $query->orWhere('contract_type',$data['contract_type']);
                }else{
                    $query->orWhere('contract_type',1);
                }
                if(array_key_exists("payment_type",$data) && $data['payment_type'] != ""){
                    $query->orWhere('payment_type',$data['payment_type']);
                }else{
                    $query->orWhere('payment_type','postpaid');
                }
                if(array_key_exists("pay_as_usage_type",$data)){
                    $query->orWhere('pay_as_usage_type',$data['pay_as_usage_type']);
                }
            });
            
            $mainQuery->orderBy('distance','ASC');
            $searchResultCount = $mainQuery->count();
            $searchResult = $mainQuery->paginate($limit);
            
            foreach($searchResult as $key => $value){
                $user_address = '';
                $sum = 0;
                $average = 0;
                $user_address = UserAddress::where('user_id',$searchResult[$key]['user_id'])->where('is_primary',1)->value('formatted_address');
                $searchResult[$key]['user_address'] = $user_address;
            }
            if($user_id){
                $logData = [
                    'user_id'                       => $user->id,
                    'log_type'                      => 5,
                    'type'                          => 2,
                    'filter_type'                   => 1,
                    'user_status'                   => $user->is_active,
                    'user_name'                     => $user->firstname.' '.$user->lastname,
                    'user_number'                   => $user->mobile_number,
                    'email'                         => $user->email,
                    'filter_params'                 => json_encode($data),
                    'filter_search_result_count'    => $searchResultCount
                ];
            }else{
                $logData = [
                    'log_type'                      => 5,
                    'type'                          => 2,
                    'filter_type'                   => 1,
                    'ip'                            => $ip,
                    'filter_params'                 => json_encode($data),
                    'filter_search_result_count'    => $searchResultCount
                ];
            }
            CreateLogs::createLog($logData);
            return view('FrontEnd.plansResult',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'googleads'=>$googleads,'service_types' => $service_types,'data' => $searchResult,'filterType' => $filter]);
        }else{
            $searchResult = [];
            $filter = 1;
            return view('FrontEnd.plansResult',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'googleads'=>$googleads,'service_types' => $service_types,'data' => $searchResult,'filterType' => $filter]);
        }

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
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;
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
        $mainQuery = ServiceReview::query();
        $mainQuery->select(DB::raw('*, ( 6371 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
        ->where('country_code',$current_country_code)
        ->with('provider','currency','typeOfService');
        $mainQuery->where(function ($query) use ($data) {
            if(array_key_exists("service_type",$data) && $data['service_type'] != ""){
                $query->orWhere('service_type',$data['service_type']);
            }
            if(array_key_exists("contract_type",$data) && $data['contract_type'] != ""){
                $query->orWhere('contract_type',$data['contract_type']);
            }else{
                $query->orWhere('contract_type',1);
            }
            if(array_key_exists("payment_type",$data) && $data['payment_type'] != ""){
                $query->orWhere('payment_type',$data['payment_type']);
            }else{
                $query->orWhere('payment_type','postpaid');
            }
            if(array_key_exists("pay_as_usage_type",$data) && $data['pay_as_usage_type'] != ""){
                $query->orWhere('pay_as_usage_type',$data['pay_as_usage_type']);
            }
        });
        $mainQuery->orderBy($params['name'],$params['sort']);
        $searchResultCount = $mainQuery->count();
        $searchResult = $mainQuery->paginate($limit);
        
        foreach($searchResult as $key => $value){
            $user_address = '';
            $sum = 0;
            $average = 0;
            $user_address = UserAddress::where('user_id',$searchResult[$key]['user_id'])->where('is_primary',1)->value('formatted_address');
            $searchResult[$key]['user_address'] = $user_address;
        }
        return view('FrontEnd.plans.planSorting',['data' => $searchResult,'filtersetting'=>$filtersetting,'ads'=>$ads,'googleads'=>$googleads]);
    }
    public function planDetails($lang,$id){
        $planDetailData = ServiceReview::where('id',$id)->with('provider','currency','typeOfService')->first();
       
        $user_address = UserAddress::where('user_id',$planDetailData->user_id)->where('is_primary',1)->value('formatted_address');
        $planDetailData->user_address = $user_address;
        $allratings = $planDetailData->get_ratings($id);
        $plan_device_rating = $planDetailData->plan_device_rating->toArray();
        $key = [];
        $blankArray = [];
        
        foreach ($allratings as $ratings) {
            if($ratings->entity_id == $planDetailData->id && $ratings->entity_type==1){    //Check entity id is equal to plan id
                $ratings->question_name = $ratings->question['question'];
                $ratings->question_type = $ratings->question['type'];
                unset( $ratings->question);
                if(!in_array($ratings->rating_id, $key)){
                    $key[]=$ratings->rating_id;
                    $blankArray[$ratings->rating_id]['plan_id'] = $ratings->entity_id;
                    $blankArray[$ratings->rating_id]['ratingList'][]=$ratings->toArray();
                }else{

                    $blankArray[$ratings->rating_id]['plan_id'] = $ratings->entity_id;
                    $blankArray[$ratings->rating_id]['ratingList'][]=$ratings->toArray();

                }
            }
        }
        foreach ($plan_device_rating as $plan_device) {
            if($plan_device['plan_id'] == $planDetailData->id){  //Check plan_id is equal to plan id
                $address = UserAddress::find($plan_device['user_address_id']);
                if($address['formatted_address'] != NULL && $address['formatted_address'] != ''){
                    $blankArray[$plan_device['rating_id']]['formatted_address']=$address['city'].' '.$address['country'].' '.$address['postal_code'];
                    // $blankArray[$plan_device['rating_id']]['formatted_address']=$address['formatted_address'];
                }else{
                    $blankArray[$plan_device['rating_id']]['formatted_address']='N/A';
                }
                $blankArray[$plan_device['rating_id']]['date']=$plan_device['created_at'];
                $blankArray[$plan_device['rating_id']]['comment']=$plan_device['comment'];
                $blankArray[$plan_device['rating_id']]['average']=$plan_device['average'];
                $blankArray[$plan_device['rating_id']]['user_address_id']=$plan_device['user_address_id'];
            }
        }
        $planDetailData->ratings = $blankArray;
            // echo "<pre>";print_r($planDetailData->toArray());die;
        return view('FrontEnd.planDetail',['service' => $planDetailData]);
    }
}

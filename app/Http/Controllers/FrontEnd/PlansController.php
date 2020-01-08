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
            
            $searchResultCount = ServiceReview::select(DB::raw('*, ( 6367 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
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

            $searchResult = ServiceReview::select(DB::raw('*, ( 6367 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
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
            $searchResult = ServiceReview::select(DB::raw('*, ( 6367 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
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
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function plans_old(Request $request)
    {
        // Current location section
        $ip = env('ip_address','live');
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip = '96.46.34.142';
            // $ip = '2606:4580:2:0:a974:e358:829c:412e';
            // $ip = '122.173.84.243';
        }
        // $ip = '96.46.34.142';
        $data = \Location::get($ip);
        // echo "latitude => ".$data->latitude.'<br>';
        // echo "longitude => ".$data->longitude;
        // exit;
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&latlng='.$data->latitude.','.$data->longitude);
        $response = json_decode($response->getBody());
        $current_location = $response->results[0]->formatted_address;
        $current_lat = $data->latitude;
        $current_long = $data->longitude;
        $current_country_code = $data->countryCode;
        $filtersetting = SettingsModel::first();
        
        if($filtersetting->ads_setting == 0){
            $ads = AdsModel::where('type',0)->get();
        }else{
            $ads = AdsModel::where('type',1)->first();
        }
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        $data=array();
        $data=$request->all();
                // echo "<pre>";print_r($data);die;
        if($data){
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
            $searchResult = ServiceReview::select(DB::raw('*, ( 6367 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
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
                        ->get()->toArray();
                // if($filter == 1){
                //     $searchResult = ServiceReview::select(DB::raw('*, ( 6367 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                //     ->where('country_code',$current_country_code)->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                //                         $query->orWhere('contract_type',$contract_type)
                //                         ->orWhere('payment_type',$payment_type)
                //                         ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                //                         ->orWhere('service_type',$service_type);
                //                             })->with('provider','currency','typeOfService')
                //                             ->orderBy('distance','ASC')
                //                             ->orderBy('local_min','DESC')
                //                             ->orderBy('datavolume','DESC')
                //                             ->orderBy('price','ASC')
                //                             ->orderBy('average_review','DESC')
                //                             ->get()->toArray();
                // }elseif($filter == 2){
                //     $searchResult = ServiceReview::where('country_code',$current_country_code)->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                //                             $query->orWhere('contract_type',$contract_type)
                //                             ->orWhere('payment_type',$payment_type)
                //                             ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                //                             ->orWhere('service_type',$service_type);
                //                                 })->with('provider','currency','typeOfService')
                //                                 ->orderBy('price','ASC')
                //                                 ->get()->toArray();
                // }elseif($filter == 3){
                //     $searchResult = ServiceReview::where('country_code',$current_country_code)->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                //         $query->orWhere('contract_type',$contract_type)
                //         ->orWhere('payment_type',$payment_type)
                //         ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                //         ->orWhere('service_type',$service_type);
                //             })->with('provider','currency','typeOfService')
                //             ->orderBy('local_min','DESC')
                //             ->get()->toArray();
                // }elseif($filter == 4){
                //     $searchResult = ServiceReview::where('country_code',$current_country_code)->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                //         $query->orWhere('contract_type',$contract_type)
                //         ->orWhere('payment_type',$payment_type)
                //         ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                //         ->orWhere('service_type',$service_type);
                //             })->with('provider','currency','typeOfService')
                //             ->orderBy('datavolume','DESC')
                //             ->get()->toArray();
                // }elseif($filter == 5){
                //     $searchResult = ServiceReview::where('country_code',$current_country_code)->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                //         $query->orWhere('contract_type',$contract_type)
                //         ->orWhere('payment_type',$payment_type)
                //         ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                //         ->orWhere('service_type',$service_type);
                //             })->with('provider','currency','typeOfService')
                //             ->orderBy('average_review','DESC')
                //             ->get()->toArray();
                // }
                // print "<pre>"; print_r($searchResult);die;
                foreach($searchResult as $key => $value){
                    $user_address = '';
                    $sum = 0;
                    $average = 0;
                    $user_address = UserAddress::where('user_id',$searchResult[$key]['user_id'])->where('is_primary',1)->value('formatted_address');
                    $searchResult[$key]['user_address'] = $user_address;
                    // $plan_device_rating_count = PlanDeviceRating::where('plan_id',$searchResult[$key]['id'])->count();
                    // $plan_device_rating = PlanDeviceRating::where('plan_id',$searchResult[$key]['id'])->pluck('average');
                    // foreach($plan_device_rating as $key2 => $value2){
                    //     $sum = $sum + $value2; 
                    // }
                    // if($plan_device_rating_count == 0){
                    //     $average = $sum;
                    // }else{
                    //     $average = $sum/$plan_device_rating_count;
                    // }
                    // $searchResult[$key]['average_review'] = $average;
                }                
                // echo "<pre>";print_r($searchResult);die;
            return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'service_types' => $service_types,'data' => $searchResult,'filterType' => $filter]);

        }else{

            $searchResult = ServiceReview::select(DB::raw('*, ( 6367 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
            ->where('country_code',$current_country_code)
            ->with('provider','currency','typeOfService')
                    ->orderBy('distance','ASC')
                    ->orderBy('local_min','DESC')
                    ->orderBy('datavolume','DESC')
                    ->orderBy('price','ASC')
                    ->orderBy('average_review','DESC')
                    ->paginate(30);
                    // echo "<pre>";
                    // print_r($searchResult);
                    // exit;
            return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'data'=>$searchResult,'service_types' => $service_types,]);
        }               
        
    }

    public function planDetails($id){
        $planDetailData = ServiceReview::where('id',$id)->with('provider','currency','typeOfService')->first();
       
        $user_address = UserAddress::where('user_id',$planDetailData->user_id)->where('is_primary',1)->value('formatted_address');
        $planDetailData->user_address = $user_address;
        $allratings = $planDetailData->get_ratings();
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
                    $blankArray[$plan_device['rating_id']]['formatted_address']=$address['formatted_address'];
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

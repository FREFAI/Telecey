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
        // End Current location section

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
        if($data){
            $contract_type="";
            $payment_type="";
            $pay_as_usage_type="";
            $service_type= $data['service_type'];
            $user_id = Auth::guard('customer')->id();
            if(array_key_exists("contract_type",$data)){
                $contract_type = $data['contract_type'];
            }elseif(array_key_exists("payment_type",$data)){
                $payment_type = $data['payment_type'];
            }elseif(array_key_exists("pay_as_usage_type",$data)){
                $pay_as_usage_type = $data['pay_as_usage_type'];
            }
            $searchResult = ServiceReview::where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                                $query->orWhere('contract_type',$contract_type)
                                ->orWhere('payment_type',$payment_type)
                                ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                                ->orWhere('service_type',$service_type);
                            })->with('provider','currency','typeOfService')
                            ->get()->toArray();
            foreach($searchResult as $key => $value){
                $user_address = '';
                $sum = 0;
                $average = 0;
                $user_address = UserAddress::where('user_id',$searchResult[$key]['user_id'])->where('is_primary',1)->value('formatted_address');
                $searchResult[$key]['user_address'] = $user_address;
                $plan_device_rating_count = PlanDeviceRating::where('plan_id',$searchResult[$key]['id'])->count();
                $plan_device_rating = PlanDeviceRating::where('plan_id',$searchResult[$key]['id'])->pluck('average');
                foreach($plan_device_rating as $key2 => $value2){
                    $sum = $sum + $value2; 
                }
                $average = $sum/$plan_device_rating_count;
                $searchResult[$key]['average_review'] = $average;
            }                
                // echo "<pre>";print_r($searchResult);die;
            return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'service_types' => $service_types,'data' => $searchResult]);

        }
        return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'data'=>$data,'service_types' => $service_types]);
    }

    public function planDetails($id){
        $planDetailData = ServiceReview::where('id',$id)->with('provider','currency','typeOfService')->first();
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
            // echo "<pre>";print_r($planDetailData->ratings);die;
        return view('FrontEnd.planDetail',['service' => $planDetailData]);
    }
}

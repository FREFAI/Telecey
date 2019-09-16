<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\AdsModel;
use App\Models\Admin\ServiceType;
use App\Models\FrontEnd\ServiceReview;
use Illuminate\Support\Facades\Auth;


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
        // $serviceReviewsData = ServiceReview::where('user_id',$user_id)->with('provider','currency','typeOfService')->get()->toArray();
        // echo "<pre>";
        // print_r($serviceReviewsData);
        // exit;
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
            // echo "<pre>";print_r($data);die;
            $searchResult = ServiceReview::where('user_id',$user_id)
                            ->where(function ($query) use ($contract_type,$payment_type,$pay_as_usage_type,$service_type) {
                                $query->orWhere('contract_type',$contract_type)
                                ->orWhere('payment_type',$payment_type)
                                ->orWhere('pay_as_usage_type',$pay_as_usage_type)
                                ->orWhere('service_type',$service_type);
                            })->with('provider','currency','typeOfService')
                            ->get()->toArray();
            // echo "<pre>";print_r($searchResult);die;
            return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'service_types' => $service_types,'data' => $searchResult]);

        }
        return view('FrontEnd.plans',['ip_location'=>$current_location,'filtersetting'=>$filtersetting,'ads'=>$ads,'data'=>$data,'service_types' => $service_types]);
    }
}

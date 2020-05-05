<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\DeviceReview;
use App\Models\Admin\Brands;
use App\Models\FrontEnd\ServiceRating;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\HomeContent;
use App\Models\FrontEnd\PlanDeviceRating;
use Auth;
use App\UserAddress;
use App\Models\Admin\ServiceType;
use App\User;

class HomeController extends Controller
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
    public function homepage()
    {
        $settings = SettingsModel::first();
        $blogs = BlogsModel::orderBy('created_at','DESC')->take(3)->get();
        return view('FrontEnd.homepage',['settings'=> $settings,'blogs'=>$blogs]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function homePageNew()
    {
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
        $settings = SettingsModel::first();
        $homeContent = HomeContent::first();
        $filtersetting = SettingsModel::first();
        $service_types = ServiceType::get();
        $brands = Brands::all();
        $homeContent->section_six = json_decode($homeContent->section_six);
        $blogs = BlogsModel::orderBy('created_at','DESC')->where('status',1)->take(4)->get();
        return view('FrontEnd.homepagenew',['ip_location'=>$current_location,'brands' => $brands,'settings'=> $settings,'blogs'=>$blogs,'homeContent'=>$homeContent,'filtersetting'=>$filtersetting,'service_types' => $service_types]);
    }

    public function profile(Request $request)
    {
        $perameters = $request->all();
        if(array_key_exists('type', $perameters)){
            if($perameters['type'] == 1){
                $data = $this->getAllPlans();
            }else{
                // $data = $this->getAllPlans();
                $data = $this->getAllDevice();
            }
        }else{
            $data = $this->getAllPlans();
        }
        $serviceData = $data['serviceData'];
        $customer = $data['customer'];
        // echo "<pre>";
        // print_r($serviceData);
        // exit;
        return view('FrontEnd.profile',['serviceData'=>$serviceData,'customer'=>$customer]);
    }

    public function getAllPlans()
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
        $customer = User::find($user_id);
        if($userAddress){
            $customer->userAdderss= $userAddress->toArray();
        }
        $serviceDatacount = ServiceReview::where('user_id',$user_id)->count();
        $planReviewCount = PlanDeviceRating::where('user_id',$user_id)->where('plan_id','!=','0')->count();
        $deviceDatacount = DeviceReview::where('user_id',$user_id)->count();
        $deviceReviewCount = PlanDeviceRating::where('user_id',$user_id)->where('device_id','!=','0')->count();
        $customer->planCount = $serviceDatacount;
        $customer->planReviewCount = $planReviewCount;
        $customer->deviceDatacount = $deviceDatacount;
        $customer->deviceReviewCount = $deviceReviewCount;


        $serviceData = ServiceReview::where('user_id',$user_id)
                        ->orderBy('created_at','DESC')
                        ->paginate(10);
        $key = [];
        foreach ($serviceData  as $data) {
            $blankArray = [];
            $id = $data->id;
            $data->brand;   // For brand name
            $data->provider;   // For provider name
            $data->typeOfService;    // Type name
            $data->currency;     // Currency name
            $allratings = $data->get_ratings($id);  // Get all ratings of this plan questions
            $plan_device_rating = $data->plan_device_rating->toArray();   // Get all subratings of this plan and get average, comment,created date and user_address_id
            unset($data->plan_device_rating);
            foreach ($allratings as $ratings) {
                if($ratings->entity_id == $data->id && $ratings->entity_type==1){    //Check entity id is equal to plan id
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
            // Set average, comment,created date,user_address_id adn formatted_address in plan array
            foreach ($plan_device_rating as $plan_device) {
                if($plan_device['plan_id'] == $data->id){  //Check plan_id is equal to plan id
                    if($plan_device['formatted_address'] != NULL && $plan_device['formatted_address'] != ''){
                        $blankArray[$plan_device['rating_id']]['formatted_address']=$plan_device['city'].' '.$plan_device['country'].' '.$plan_device['postal_code'];
                        // $blankArray[$plan_device['rating_id']]['formatted_address']=$plan_device['formatted_address'];
                    }else{
                        $blankArray[$plan_device['rating_id']]['formatted_address']='N/A';
                    }
                    $blankArray[$plan_device['rating_id']]['date']=$plan_device['created_at'];
                    $blankArray[$plan_device['rating_id']]['comment']=$plan_device['comment'];
                    $blankArray[$plan_device['rating_id']]['average']=$plan_device['average'];
                    $blankArray[$plan_device['rating_id']]['user_address_id']=$plan_device['user_address_id'];
                    
                }
            }
            $data->ratings = $blankArray;
        }
        return $data = [
            'customer'    => $customer,
            'serviceData' => $serviceData
        ];
    }

    public function getAllDevice()
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
        $customer = User::find($user_id);
        if($userAddress){
            $customer->userAdderss= $userAddress->toArray();
        }
        $serviceDatacount = ServiceReview::where('user_id',$user_id)->count();
        $planReviewCount = PlanDeviceRating::where('user_id',$user_id)->where('plan_id','!=','0')->count();
        $deviceDatacount = DeviceReview::where('user_id',$user_id)->count();
        $deviceReviewCount = PlanDeviceRating::where('user_id',$user_id)->where('device_id','!=','0')->count();
        $customer->planCount = $serviceDatacount;
        $customer->planReviewCount = $planReviewCount;
        $customer->deviceDatacount = $deviceDatacount;
        $customer->deviceReviewCount = $deviceReviewCount;

        $deviceData = DeviceReview::where('user_id',$user_id)
                        ->orderBy('created_at','DESC')
                        ->paginate(10);
        $key = [];
        foreach ($deviceData as $device) {
            $blankArray = [];
            $device->device_name = $device->device->device_name;
            $device->device_status = $device->device->status;
            $device->brand_name = $device->brand->brand_name;
            $device->brand_status = $device->brand->status;
            $device->model_name = $device->brand->model_name;
            $device->model_status = $device->brand->status;
            $device->supplier_name = $device->supplier['supplier_name'];
            $allratings = $device->get_ratings($device->id);  // Get all ratings of this plan questions
            $plan_device_rating = $device->plan_device_rating->toArray();   // Get all subratings of this plan and get average, comment,created date and user_address_id
            foreach ($allratings as $ratings) {
                if($ratings->entity_id == $device->id && $ratings->entity_type==2){    //Check entity id is equal to plan id
                    $ratings->question_name = $ratings->question['question'];
                    $ratings->question_type = $ratings->question['type'];
                    unset( $ratings->question);
                    if(!in_array($ratings->rating_id, $key)){
                        $key[]=$ratings->rating_id;
                        $blankArray[$ratings->rating_id]['device_id'] = $ratings->entity_id;
                        $blankArray[$ratings->rating_id]['ratingList'][]=$ratings->toArray();
                    }else{

                        $blankArray[$ratings->rating_id]['device_id'] = $ratings->entity_id;
                        $blankArray[$ratings->rating_id]['ratingList'][]=$ratings->toArray();

                    }
                }
            }
            // Set average, comment,created date,user_address_id adn formatted_address in plan array
            foreach ($plan_device_rating as $plan_device) {
                if($plan_device['device_id'] == $device->id){  //Check device_id is equal to plan id
                    if($plan_device['formatted_address'] != NULL && $plan_device['formatted_address'] != ''){
                        // $blankArray[$plan_device['rating_id']]['formatted_address']=$plan_device['formatted_address'];
                        $blankArray[$plan_device['rating_id']]['formatted_address']=$plan_device['city'].' '.$plan_device['country'].' '.$plan_device['postal_code'];
                    }else{
                        $blankArray[$plan_device['rating_id']]['formatted_address']='N/A';
                    }
                    $blankArray[$plan_device['rating_id']]['date']=$plan_device['created_at'];
                    $blankArray[$plan_device['rating_id']]['comment']=$plan_device['comment'];
                    $blankArray[$plan_device['rating_id']]['average']=$plan_device['average'];
                    $blankArray[$plan_device['rating_id']]['user_address_id']=$plan_device['user_address_id'];
                    
                }
            }
            $device->ratings = $blankArray;
            unset($device->device);
            unset($device->brand);
            unset($device->supplier);
            unset($device->plan_device_rating);
        }              
        
        // echo "<pre>";
        // print_r($deviceData->toArray());
        // exit;
        return $data = [
            'customer'    => $customer,
            'serviceData' => $deviceData
        ];
    }
    public function getAddress(Request $request)
    {
        $input = $request->all();
        
        $validation = Validator::make($input, [
            'user_id' => 'required',
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $address = UserAddress::where('user_id',$input['user_id'])->where('is_primary',1)->first();
            if($address){
                $ret = array('success'=>1, 'data'=>$address->toArray());
                return json_encode($ret);
            }else{
                $ret = array('success'=>0, 'data'=>[]);
                return json_encode($ret);
            }
        }
    }
    public function changeAddress(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'country' => 'required',
            'city' => 'required',
            'postal_code' => 'required',
            'id' => 'required'
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $addressUpdate = UserAddress::find($input['id']);
            if($input['address'] != ""){
                $formatted = $input['address'].' '.$input['city'].' '.$input['country'].' '.$input['postal_code'];
            }else{
                $formatted = $input['city'].' '.$input['country'].' '.$input['postal_code'];
            }
            $addressUpdate->address = $input['address'];
            $addressUpdate->country = $input['country'];
            $addressUpdate->country_code = $input['country_code'];
            $addressUpdate->city = $input['city'];
            $addressUpdate->postal_code = $input['postal_code'];
            $addressUpdate->formatted_address = $formatted;
            if($addressUpdate->save()){
                return redirect()->back()->withInput()->with('success','Address update successfully');
                // $ret = array('success'=>1, 'message'=>"Address update successfully.",'address'=>$formatted);
                // return json_encode($ret);
            }else{
                return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                // $ret = array('success'=>0, 'message'=>"Somthing went wrong!",'address'=>"");
                // return json_encode($ret);
            }
        }
    }
}

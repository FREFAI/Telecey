<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\UserAddress;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\PlanDeviceRating;
use App\Models\FrontEnd\DeviceReview;

class UsersController extends Controller
{
    public function index(Request $request)
    {
    	$users = User::orderBy('id','DESC')->paginate(10);
    	foreach ($users as $user) {
    		$plans = $user->plans;
    		foreach ($plans as $plan) {
    			$plan->provider;
    		}
    		$user->unApprovedCount = $user->getUnapprovedProviders()->count();
    		$user->plansCount = $user->plans->count();
    		$user->devicesCount = $user->devices->count();
    	}
    	return view('Admin.Users.users-list',['users'=>$users]);
    }
    public function searchUser(Request $request)
    {
        $perameters = $request->all();
        if($perameters['name'] != "" && $perameters['email'] == ""){
            $users = User::where(function ($query) use ($perameters){
                $query->where('firstname','LIKE',"%{$perameters['name']}%")
                      ->orwhere('lastname','LIKE',"%{$perameters['name']}%");
            })->orderBy('id','DESC')->paginate(10);
        }elseif($perameters['name'] == "" && $perameters['email'] != ""){
            $users = User::where(function ($query) use ($perameters){
                $query->where('email','LIKE',"%{$perameters['email']}%");
            })->orderBy('id','DESC')->paginate(10);
        }else{
            $users = User::where(function ($query) use ($perameters){
                $query->where('firstname','LIKE',"%{$perameters['name']}%")
                      ->orwhere('lastname','LIKE',"%{$perameters['name']}%");
            })->where(function ($query) use ($perameters){
                $query->where('email','LIKE',"%{$perameters['email']}%");
            })->orderBy('id','DESC')->paginate(10);
        }
        foreach ($users as $user) {
            $plans = $user->plans;
            foreach ($plans as $plan) {
                $plan->provider;
            }
            $user->unApprovedCount = $user->getUnapprovedProviders()->count();
            $user->plansCount = $user->plans->count();
            $user->devicesCount = $user->devices->count();
        }
        return view('Admin.Users.users-list',['users'=>$users,'request'=>$perameters]);
    }
    public function getSingleUserDetail(Request $request,$userId)
    {
        $perameters = $request->all();
        $userId = base64_decode($userId);
        $user = User::find($userId);
        $user->userPrimaryAddress = $user->getUserPrimaryAdderss();
        $user->providers;
        $user->plansCount = $user->plans->count();
        $user->devicesCount = $user->devices->count();
        if(array_key_exists('type', $perameters)){
            $perameters['type'] = base64_decode($perameters['type']);
            if($perameters['type'] == 1){
                $data = $this->getAllPlans($userId);
            }else{
                // $data = $this->getAllPlans();
                $data = $this->getAllDevice($userId);
            }
        }else{
            $data = $this->getAllPlans($userId);
        }
        $serviceData = $data;
        // echo "<pre>";
        // print_r($serviceData->toArray());
        // exit;
        return view('Admin.Users.users-detail',['serviceData'=>$serviceData,'user'=>$user]);
    }

    public function getAllPlans($userId)
    {
        $user_id = $userId;
        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
        $customer = User::find($user_id);
        if($userAddress){
            $customer->userAdderss= $userAddress->toArray();
        }
        $serviceData = ServiceReview::where('user_id',$user_id)
                        ->orderBy('created_at','DESC')
                        ->paginate(10);
        $key = [];
        $blankArray = [];
        foreach ($serviceData  as $data) {
            $data->provider;   // For provider name
            $data->typeOfService;    // Type name
            $data->currency;     // Currency name
            $allratings = $data->get_ratings();  // Get all ratings of this plan questions
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
            $data->ratings = $blankArray;
        }
        return  $serviceData;
    }

    public function getAllDevice($userId)
    {
        $user_id = $userId;
        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
        $customer = User::find($user_id);
        if($userAddress){
            $customer->userAdderss= $userAddress->toArray();
        }
 
        $deviceData = DeviceReview::where('user_id',$user_id)
                        ->orderBy('created_at','DESC')
                        ->paginate(10);
        $key = [];
        $blankArray = [];
        foreach ($deviceData as $device) {
            $device->device_name = $device->device->device_name;
            $device->device_status = $device->device->status;
            $device->brand_name = $device->brand->brand_name;
            $device->brand_status = $device->brand->status;
            $device->model_name = $device->model->model_name;
            $device->model_status = $device->model->status;
            $allratings = $device->get_ratings();  // Get all ratings of this plan questions
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
            $device->ratings = $blankArray;
            unset($device->device);
            unset($device->brand);
            unset($device->model);
            unset($device->plan_device_rating);
        }              
        
        // echo "<pre>";
        // print_r($deviceData->toArray());
        // exit;
        return  $deviceData;
    }
}

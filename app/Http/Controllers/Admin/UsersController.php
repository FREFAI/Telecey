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
use App\Models\Admin\Brands;
use App\Models\Admin\Provider;
use Excel;

class UsersController extends Controller
{






    public function index(Request $request)
    {
    
        $current_url = \Request::getRequestUri();
        $request->session()->put('backUrlUser', $current_url);

        $name=$request->get('name');
        $email=$request->get('email');
        $parameter = $request->all();
      if( empty($name) && empty($email) ){
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
        } 
        else{
                $users = $this->searchUser($request);
        }
    	return view('Admin.Users.users-list',['users'=>$users,'request'=>$parameter]);
    }
    public function searchUser(Request $request)
    {
        $parameter = $request->all();
        // $page = $request->has('page') ? $request->get('page') : 1;
        // $limit = $request->has('limit') ? $request->get('limit') : 10;
        $query = User::query();
        if(isset($parameter['name']) != ""){
            if(isset($parameter['status']) != 3){
                $query->where(function ($query) use ($parameter){
                    $query->where('firstname','LIKE',"%{$parameter['name']}%")
                          ->orwhere('lastname','LIKE',"%{$parameter['name']}%");
                });
            }else{
                $query->where(function ($query) use ($parameter){
                    $query->where('users.firstname','LIKE',"%{$parameter['name']}%")
                      ->orwhere('users.lastname','LIKE',"%{$parameter['name']}%");
                });
            }
        }
        if(isset($parameter['email']) != ""){
            if(isset($parameter['status']) != 3){
                $query->where('email','LIKE',"%{$parameter['email']}%");
            }else{
                $query->where('users.email','LIKE',"%{$parameter['email']}%");
            }
        }
        if(isset($parameter['created_at']) != ""){
            if(isset($parameter['status']) != 3){
                $parameter['created_at'] = date('Y-m-d',strtotime($parameter['created_at']));
                $query->where('created_at','LIKE',"%{$parameter['created_at']}%");
            }else{
                $parameter['created_at'] = date('Y-m-d',strtotime($parameter['created_at']));
                $query->where('users.created_at','LIKE',"%{$parameter['created_at']}%");
            }
        }
        if(isset($parameter['updated_at']) != ""){
            if($parameter['status'] != 3){
                $parameter['updated_at'] = date('Y-m-d',strtotime($parameter['updated_at']));
                $query->where('updated_at','LIKE',"%{$parameter['updated_at']}%");
            }else{
                $parameter['updated_at'] = date('Y-m-d',strtotime($parameter['updated_at']));
                $query->where('users.updated_at','LIKE',"%{$parameter['updated_at']}%");
            }
        }
        // if($parameter['plans'] != ""){
        //     if($parameter['status'] != 3){
        //         $qyery->has('')
        //         $query->withCount('plans')->having('plans_count', '=', $parameter['plans']);
        //     }else{
        //         $query->withCount('plans')->having('plans_count', '=', $parameter['plans']);
        //     }
        // }
        // if($parameter['devices'] != ""){
        //     if($parameter['status'] != 3){
        //         $query->withCount('devices')->having('devices_count', '=', $parameter['devices']);
        //     }else{
        //         $query->withCount('devices')->having('devices_count', '=', $parameter['devices']);
        //     }
        // }
        if(isset($parameter['search_by_properties']) != ""){

            $brands_IDs = Brands::where(function ($brandquery) use ($parameter){
                $brandquery->where('brand_name','LIKE',"%{$parameter['search_by_properties']}%")
                           ->orwhere('model_name','LIKE',"%{$parameter['search_by_properties']}%");
                })->pluck('id')->toArray();
            $deviceIds = DeviceReview::whereIn('brand_id',$brands_IDs)->distinct()->pluck('user_id')->toArray();
            $providers_IDs = Provider::where(function ($providerquery) use ($parameter){
                $providerquery->where('provider_name','LIKE',"%{$parameter['search_by_properties']}%");
            })->pluck('id')->toArray();
            $serviseids = ServiceReview::whereIn('provider_id',$providers_IDs)->distinct()->pluck('user_id')->toArray();
            $ids = array_merge($deviceIds,$serviseids);
            $ids = array_unique($ids);
            $query->whereIn('id',$ids);
        }
        if(isset($parameter['status']) != "" && $parameter['status'] != 3){
            if($parameter['status'] == 2){
                $query->where('is_active',0);
            }else{
                $query->where('is_active',$parameter['status']);
            }
        }elseif(isset($parameter['status']) != "" && $parameter['status'] == 3){
            $query->select('users.*')->join('providers','providers.user_id','=','users.id')
                    ->where('providers.status','=',0);
        }
        // echo $users = $query->toSql();
        // exit;
        $users = $query->orderBy('id','DESC')->paginate(10);

        foreach ($users as $user) {
            $plans = $user->plans;
            foreach ($plans as $plan) {
                $plan->provider;
            }
            $user->unApprovedCount = $user->getUnapprovedProviders()->count();
            $user->plansCount = $user->plans->count();
            $user->devicesCount = $user->devices->count();

        }
        return $users;
        // $userCount = 100;

        // $total_pages = ceil($userCount / $limit);
        // echo "<pre>";print_r($users);
        // exit;
        // return view('Admin.Users.users-list',['users'=>$users,'request'=>$parameter]);
    }
    public function getSingleUserDetail(Request $request,$userId)
    {

        $parameter = $request->all();
        $userId = base64_decode($userId);
        $user = User::find($userId);
        $user->userPrimaryAddress = $user->getUserPrimaryAdderss();
        $user->providers;
        $user->plansCount = $user->plans->count();
        $user->devicesCount = $user->devices->count();
        if(array_key_exists('type', $parameter)){
            $parameter['type'] = base64_decode($parameter['type']);
            if($parameter['type'] == 1){
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
            $device->model_name = $device->brand->model_name;
            $device->model_status = $device->brand->status;
            $device->supplier_name = $device->supplier['supplier_name'];
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

    public function exportUsers(){
        
        $users = User::orderBy('id','DESC')->get();
    	foreach ($users as $user) {
    		$plans = $user->plans;
    		foreach ($plans as $plan) {
    			$plan->provider;
    		}
    		$user->unApprovedCount = $user->getUnapprovedProviders()->count();
    		$user->plansCount = $user->plans->count();
            $user->devicesCount = $user->devices->count();
            $user->name = $user->firstname." ".$user->lastname;
            if($user->plansCount == 0 && $user->devicesCount == 0){
                $user->account_type = "none";
            }elseif($user->plansCount != 0 && $user->devicesCount != 0){
                $user->account_type = "Plan & Device";
            }elseif($user->plansCount != 0 && $user->devicesCount == 0){
                $user->account_type = "Plan";
            }elseif($user->plansCount == 0 && $user->devicesCount != 0){
                $user->account_type = "Device";
            }
            if($user->is_active == 0){
                $user->status = "Pending verification";
            }elseif($user->unApprovedCount != 0){
                $user->status = "Pending Product approval";
            }elseif($user->is_active == 1){
                $user->status = "Active";
            }
            $user->creation_date = date("m/d/Y", strtotime($user->created_at));
            $user->last_update = date("m/d/Y", strtotime($user->updated_at));
        }
        if(count($users)>0){
            $customer_array[] = array('NAME','NICK NAME','ACCOUNT TYPE','STATUS','NO. OF PLANS','NO. OF DEVICES','CREATION DATE','LAST UPDATE');

            foreach($users as $user)
            {
              $customer_array[] = array(
                'NAME'=> $user->name,
                'NICK NAME'=> $user->nickname,
                'ACCOUNT TYPE'=> $user->account_type,
                'STATUS'=> $user->status,
                'NO. OF PLANS'=> $user->plansCount,
                'NO. OF DEVICES'=> $user->devicesCount,
                'CREATION DATE'=> $user->creation_date,
                'LAST UPDATE'=> $user->last_update
                );
            }
            $filename = "user" . date('d-m-Y');
            return Excel::create($filename, function($excel) use ($customer_array){
              $excel->setTitle('Customer Data');
              $excel->sheet('Customer Data', function($sheet) use ($customer_array){
               $sheet->fromArray($customer_array, null, 'A1', false, false);
              });
            })->export('xlsx');

        }else{
            return redirect('/admin/users')->with('warning','No Data To Export');
        }
    }
}

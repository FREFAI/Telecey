<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\ServiceRating;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\BlogsModel;
use App\Models\FrontEnd\PlanDeviceRating;
use Auth;
use App\UserAddress;
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

    public function profile(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $customer = User::find($user_id);
        if($customer->userAdderss){
            $customer->userAdderss->toArray();
        }
        $serviceData = ServiceReview::where('user_id',$user_id)
                        ->orderBy('created_at','DESC')
                        ->get();
        $planReviewCount = PlanDeviceRating::where('user_id',$user_id)->count();
        $customer->planCount = count($serviceData);
        $customer->planReviewCount = $planReviewCount;
        $key = [];
        $blankArray = [];
        foreach ($serviceData  as $data) {
            $data->provider;
            $data->typeOfService;
            $data->currency;
            $allratings = $data->get_ratings();
            $plan_device_rating = $data->plan_device_rating->toArray();

            unset($data->plan_device_rating);
            foreach ($allratings as $ratings) {
                if($ratings->entity_id == $data->id){
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
                if($plan_device['plan_id'] == $data->id){
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
       // echo "<pre>";
       // print_r($customer);
       // exit;
        return view('FrontEnd.profile',['serviceData'=>$serviceData,'customer'=>$customer]);
    }
    public function getAddress(Request $request)
    {
        $input = $request->all();
        
        $validation = Validator::make($input, [
            'address_id' => 'required',
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $address = UserAddress::find($input['address_id'])->toArray();
            if($address){
                $ret = array('success'=>1, 'data'=>$address);
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

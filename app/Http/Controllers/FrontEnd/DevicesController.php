<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\Supplier;
use App\Models\Admin\Brands;
use App\Models\FrontEnd\DeviceReview;
use DB;
use App\UserAddress;

class DevicesController extends Controller
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
    public function devices(Request $request)
    {
        $filtersetting = SettingsModel::first();
        if($filtersetting->device == 0){
            return redirect('/');
        }

        $ip = env('ip_address','live');
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip = '96.46.34.142';
        }
        $data = \Location::get($ip);
        $current_lat = $data->latitude;
        $current_long = $data->longitude;
        $current_country_code = $data->countryCode;

        $user_id = \Auth::guard('customer')->id();
        $brands = Brands::all();
        $suppliers = Supplier::where('status',1)->get();
        // echo "<pre>";print_r($current_country_code);exit;
        $data = array();
        $data = $request->all();
        if($data){
            $brand_name = "";
            $storage = "";
            $supplier = "";
            $filter = 1;
            if(array_key_exists("brand_name",$data)){
                $brand_name = $data['brand_name'];
            }elseif(array_key_exists("storage",$data)){
                $storage = $data['storage'];
            }elseif(array_key_exists("supplier",$data)){
                $supplier = $data['supplier'];
            }

            $searchResult = DeviceReview::select(DB::raw('*, ( 6367 * acos( cos( radians('.$current_lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$current_long.') ) + sin( radians('.$current_lat.') ) * sin( radians( latitude ) ) ) ) AS distance'))
                    ->where('country_code',$current_country_code)->where(function ($query) use ($brand_name,$storage,$supplier) {
                             $query->orWhere('brand_id',$brand_name)
                                   ->orWhere('supplier_id',$supplier)
                                   ->orWhere('storage',$storage);
                                    })->with('brand','supplier')
                                    ->orderBy('distance','ASC')
                                    ->orderBy('price','ASC')
                                    ->get()->toArray();
            // echo "<pre>";print_r($searchResult);exit;
            return view('FrontEnd.devices',['brands' => $brands,'suppliers' => $suppliers,'data'=>$searchResult,'filtersetting' => $filtersetting,'filterType' => $filter]);
        }
        return view('FrontEnd.devices',['brands' => $brands,'suppliers' => $suppliers,'data' => $data,'filtersetting' => $filtersetting]);
    }

    public function deviceDetails($id){
        $planDetailData = DeviceReview::where('id',$id)->with('device','brand','supplier','currency')->first();
        $allratings = $planDetailData->get_ratings();
        $plan_device_rating = $planDetailData->plan_device_rating->toArray();
            // echo "<pre>";print_r($planDetailData->toArray());die;
        $key = [];
        $blankArray = [];
        foreach ($allratings as $ratings) {
            if($ratings->entity_id == $planDetailData->id && $ratings->entity_type==2){    //Check entity id is equal to plan id
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
            if($plan_device['device_id'] == $planDetailData->id){  //Check plan_id is equal to plan id
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
        return view('FrontEnd.deviceDetail',['service' => $planDetailData]);
    }
}

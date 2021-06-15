<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Brands;

class HomeController extends Controller
{
    /**
     * Request $request
     * Get cities list using country code
     */
    public function getCityByCountry(Request $request)
    {
        $perameters = $request->all();
        if($perameters['search'] != ''){
            $cities =  \DB::table('cities')->orderBy('name','ASC')->where('country_code',$perameters['country_code'])->where('name', 'LIKE', $perameters['search'].'%')->select('name','id')->groupBy('name')->get();
        }else{
            $cities = [];
        }
        if(count($cities)>0){
            $message = array('success'=>true,'data'=>$cities);
            return json_encode($message);
        }else{
            $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
            return json_encode($message);
        }
    }

    /**
     * Request $request
     * Get brand list by device type and display on review page
     */
    public function getBrandByType(Request $request)
    {
        $perameters = $request->all();
        if($perameters['device_type'] != ''){
            $brands = Brands::where('device_type',$perameters['device_type'])->orderBy('id','ASC')->get();
        }else{
            $brands = [];
        }
        if(count($brands)>0){
            $message = array('success'=>true,'data'=>$brands);
            return json_encode($message);
        }else{
            $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
            return json_encode($message);
        }
    }
}

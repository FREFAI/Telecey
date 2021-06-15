<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;

class FilterSettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
     * Get all filter settings 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allFilterSetting(Request $request)
    {
    	$settings = SettingsModel::first();
    	return view('Admin.Settings.filter_settings',['settings'=>$settings]);
    }


	/**
     * Update filter settings 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changeFilterSetting(Request $request)
    {
        $input = $request->all();
        $setting  = SettingsModel::first();
        if($setting == null){
            $setting = new \App\Models\Admin\SettingsModel;
            $insertArray = [
                $input['type'] => $input['status']
            ];
            $filtersettings = SettingsModel::create($insertArray);
            if($filtersettings){
                $message = array('success'=>true,'message'=>'Successfull');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
        if(!empty($input)){
            $filtersettings = SettingsModel::where('id',1)->update([$input['type']=>$input['status']]);
            if($filtersettings){
                $message = array('success'=>true,'message'=>'Successfull');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
        
    }
}

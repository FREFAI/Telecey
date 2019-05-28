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

    public function allFilterSetting(Request $request)
    {
    	$settings = SettingsModel::first();
    	return view('Admin.Settings.filter_settings',['settings'=>$settings]);
    }

    public function changeFilterSetting(Request $request)
    {
        $input = $request->all();
        $setting  = SettingsModel::first();
        if($setting == null){
            $setting = new \App\Models\Admin\SettingsModel;
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

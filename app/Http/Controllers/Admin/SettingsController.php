<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;

class SettingsController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allSetting()
    {
        $settings = SettingsModel::first();

        return view('Admin.Settings.settings',['settings'=>$settings]);
    }

    public function changeSetting(Request $request)
    {
        $input = $request->all();
        $setting  = SettingsModel::first();
        if($setting == null){
            $setting = new \App\Models\Admin\SettingsModel;
        }
        if($input['type'] == 'device'){
            $setting->device = $input['status'];
            if($setting->save()){
                $message = array('success'=>true,'message'=>'Successfull');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
        
    }
}

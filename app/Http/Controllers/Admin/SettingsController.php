<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use Illuminate\Support\Facades\Validator;


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
    
    public function addSearchRecordLimit(Request $request)
    {
        $input = $request->all();
        $setting  = SettingsModel::first();
        if($setting == null){
            $setting = new \App\Models\Admin\SettingsModel;
            $insertArray = [
                "no_of_search_record" => $input['search_number']
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
            $filtersettings = SettingsModel::where('id',1)->update(["no_of_search_record"=>$input['search_number']]);
            if($filtersettings){
                $message = array('success'=>true,'message'=>'Successfull');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
    }

    public function addNoSearchMessage(Request $request){
        $data = $request->all();
    	$validation = Validator::make($data,[
            'no_search_message' => 'required'           
		]);
		if($validation->fails()){
			return redirect()->back()->with('error',$validation->messages()->first());
		}else{
            $result = SettingsModel::where('id',1)->update(['no_search_message'=>$data['no_search_message']]);
            if($result){
    			return redirect('/admin/settings')->with('success','Message updated successfully.');
    		}else{
    			return redirect()->back()->with('error','Somthing went wrong!');
    		}
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;
class HomeController extends Controller
{
    public function index(Request $request)
    {
    	return view('Admin.Home.index');
    }
    
    
    public function termsAndConditionsForm(Request $request)
    {
        $setting = SettingsModel::first();
    	return view('Admin.Home.terms-conditions',['setting'=>$setting]);
    }
    
    public function termsAndConditions(Request $request)
    {
        $params = $request->all();
        $setting = SettingsModel::first();
        $setting->terms_and_conditions = $params['terms_condition'];
        if($setting->save()){
            return redirect()->back()->withInput()->with('success','Terms and conditions update successfully.');
        }else{
            return redirect()->back()->withInput()->with('error','Somthing went wrong!');
        }
        
        

    }
}

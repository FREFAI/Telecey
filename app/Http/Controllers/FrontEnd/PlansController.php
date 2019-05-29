<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\AdsModel;


class PlansController extends Controller
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
    public function plans()
    {
        $filtersetting = SettingsModel::first();
        $ip = env('ip_address','live');
        if($ip == 'live'){
            $ip = $_SERVER['REMOTE_ADDR'];
        }else{
            $ip = '122.173.84.243';
        }
        if($filtersetting->ads_setting == 0){
            $ads = AdsModel::where('type',0)->get();
        }else{
            $ads = AdsModel::where('type',1)->first();
        }
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        return view('FrontEnd.plans',['ip_location'=>$details,'filtersetting'=>$filtersetting,'ads'=>$ads]);
    }
}

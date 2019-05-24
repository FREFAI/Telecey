<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\SettingsModel;

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
        // $ip = '2.22.149.255';
        $ip = $_SERVER['REMOTE_ADDR'];
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));
        return view('FrontEnd.plans',['ip_location'=>$details]);
    }
}

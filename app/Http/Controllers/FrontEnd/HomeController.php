<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\ServiceRating;
use App\Models\Admin\SettingsModel;
use Auth;

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
        return view('FrontEnd.homepage',['settings'=> $settings]);
    }

    public function profile(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $serviceData = ServiceReview::where('service_reviews.user_id',$user_id)
                        ->join('service_ratings','service_ratings.service_id','=','service_reviews.id')
                        ->select('service_reviews.*','service_ratings.*','service_ratings.data_speed as data_speed_rating')
                        ->orderBy('service_reviews.created_at','DESC')
                        ->get();
        return view('FrontEnd.profile',['serviceData'=>$serviceData]);
    }
}

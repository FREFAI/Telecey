<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\ServiceRating;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\BlogsModel;
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
        $blogs = BlogsModel::orderBy('created_at','DESC')->take(3)->get();
        return view('FrontEnd.homepage',['settings'=> $settings,'blogs'=>$blogs]);
    }

    public function profile(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $serviceData = ServiceReview::where('user_id',$user_id)
                        ->get();
        $key = [];
        $blankArray = [];
        foreach ($serviceData  as $data) {
            $date['provider'] = $data->provider;
            $date['service_type'] = $data->serviceType;
            $date['currency'] = $data->currency;
            $allratings = $data->get_ratings();
            $plan_device_rating = $data->plan_device_rating->toArray();
            unset($data->plan_device_rating);
            foreach ($allratings as $ratings) {
                if($ratings->entity_id == $data->id){
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
                if($plan_device['plan_id'] == $data->id){
                    $blankArray[$plan_device['rating_id']]['date']=$plan_device['created_at'];
                    $blankArray[$plan_device['rating_id']]['comment']=$plan_device['comment'];
                    $blankArray[$plan_device['rating_id']]['average']=$plan_device['average'];
                }
            }
            $data->ratings = $blankArray;
        }
        return view('FrontEnd.profile',['serviceData'=>$serviceData]);

    }
}

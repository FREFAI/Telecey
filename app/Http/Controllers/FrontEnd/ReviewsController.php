<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class ReviewsController extends Controller
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
    public function reviews(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        if (!$request->session()->has('usersDetail')) {
            $ip = env('ip_address','live');
            if($ip == 'live'){
                $ip = $_SERVER['REMOTE_ADDR'];
            }else{
                $ip = '122.173.84.243';
            }
            // $ip = '96.46.34.142';
            $data = \Location::get($ip);
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&latlng='.$data->latitude.','.$data->longitude);
            $response = json_decode($response->getBody());
            $storableLocation = [];
            $data = [];
            $k = 0;
            $localitydata = $response->results[0]->address_components;
            foreach ($localitydata as $value) {
                $types = $value->types;
                if(in_array('locality', $types)) {
                    $storableLocation['city'] = $value->long_name;
                }
                if (in_array('administrative_area_level_1', $types)) {
                    $storableLocation['state']= $value->long_name;
                }
                if (in_array('country', $types)) {
                    $storableLocation['country'] = $value->long_name;
                    $storableLocation['country_code'] = $value->short_name;
                }
                if (in_array('postal_code', $types)) {
                    $storableLocation['postal_code'] = $value->long_name;
                }

            }
            
            $request->session()->put('usersDetail', $storableLocation); 
        }
        $usersDetailSession = $request->session()->get('usersDetail');
        $usersDetail = User::find($user_id); 
        if($usersDetail->country == ""){
            if(array_key_exists('country', $usersDetailSession)){
                $usersDetail->country = $usersDetailSession['country'];
            }else{
                $usersDetail->country = null;
            }
        }
        if($usersDetail->city == ""){
            if(array_key_exists('city', $usersDetailSession)){
                $usersDetail->city = $usersDetailSession['city'];
            }else{
                $usersDetail->city = null;
            }
        }
        if($usersDetail->postal_code == ""){
            if(array_key_exists('postal_code', $usersDetailSession)){
                $usersDetail->postal_code = $usersDetailSession['postal_code'];
            }else{
                $usersDetail->postal_code = null;
            }
        }
        $settings = SettingsModel::first();
        return view('FrontEnd.reviews',['settings'=> $settings,'usersDetail'=>$usersDetail]);
    }

    public function reviewsDetail(Request $request)
    {
        $input = $request->all();
        $user_id = Auth::guard('customer')->user()['id']; 
        $validation = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
        ]);
        if ( $validation->fails() ) {
             $message = array('success'=>false,'message'=>$validation->messages()->first());
             return json_encode($message);
        }else{
            $user = User::where('id',$user_id)->update($input);
            if($user){
                $message = array('success'=>true,'message'=>'Updated successfully.');
                return json_encode($message);
         }else{
            $message = array('success'=>false,'message'=>"Somthing went wrong!");
             return json_encode($message);
         }
        }
    }
}

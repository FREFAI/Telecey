<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
   

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getCityByCountry(Request $request)
    {
        $perameters = $request->all();
        $cities =  \DB::table('cities')->orderBy('name','DESC')->where('country_code',$perameters['country_code'])->where('name', 'LIKE', '%'. $perameters['search']. '%')->select('name','id')->get();
        if(count($cities)>0){
            $message = array('success'=>true,'data'=>$cities);
            return json_encode($message);
        }else{
            $message = array('success'=>false,'message'=>"Somthing went wrong!");
            return json_encode($message);
        }
    }
}

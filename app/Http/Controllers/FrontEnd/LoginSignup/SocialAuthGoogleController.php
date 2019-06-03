<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Socialite,Auth;
use App\User;

class SocialAuthGoogleController extends Controller
{
    /**
       * Create a redirect method to google api.
       *
       * @return void
       */
        public function redirect()
        {
            return Socialite::driver('google')->redirect();
        }
    /**
     * Return a callback method from google api.
     *
     * @return callback URL from google
     */
    public function callback()
    {
        $user = Socialite::driver('google')->user();
        $password = str_random(10);
        $password = bcrypt($password);
        $userDetail = $user->user;
        $input = [
        	'email' => $userDetail['email'],
        	'firstname' => $userDetail['given_name'],
        	'lastname' => $userDetail['family_name'],
        	'google_id' => $userDetail['sub'],
        	'social_login_type' => 1,
        	'password' => $password

        ];
        $validation = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
            'google_id' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ( $validation->fails() ) {
        	if($validation->messages()->first('google_id')){
        	    $user = User::Where('google_id',$input['google_id'])->first();
        	    if(Auth::guard('customer')->loginUsingId($user->id)){
	        		return redirect()->to('/reviews');
	        	}else{
	        		return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
	        	}
        	}
            if($validation->messages()->first('email')){
                $user = User::Where('email',$input['email'])->first();
                if($user->social_login_type == 1){
                	if(Auth::guard('customer')->loginUsingId($user->id)){
		        		return redirect()->to('/reviews');
		        	}else{
		        		return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
		        	}	
                }else{
                	$user->social_login_type = 1;
                	$user->google_id = $input['google_id'];
                	if($user->save()){
	                	if(Auth::guard('customer')->loginUsingId($user->id)){
			        		return redirect()->to('/reviews');
			        	}else{
			        		return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
			        	}
			        }else{
			        	return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
			        }
                }
            }
            
            return redirect('/signup')->withInput()->with('error',$validation->messages()->first());
            
        }else{
	        $add = User::create($input);
	        if($add){
	        	if(Auth::guard('customer')->loginUsingId($add->id)){
	        		return redirect()->to('/reviews');
	        	}else{
	        		return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
	        	}	
	        }else{
	        	return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
	        }
	    }
    }
}

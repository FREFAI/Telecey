<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\GenerateNickName;
use App\Helpers\CreateLogs;
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
        $nickname = GenerateNickName::nickName($userDetail['given_name']);

        $input = [
        	'email' => $userDetail['email'],
        	'firstname' => $userDetail['given_name'],
        	'lastname' => $userDetail['family_name'],
        	'google_id' => $userDetail['sub'],
        	'social_login_type' => 1,
        	'password' => $password,
            'nickname' => $nickname
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
                    $url = \Session::get('locale').'/profile';
	        		return redirect()->to($url);
	        	}else{
                    $url = \Session::get('locale').'/signup';
	        		return redirect($url)->withInput()->with('error',__('index.Somthing went wrong'));
	        	}
        	}
            if($validation->messages()->first('email')){
                $user = User::Where('email',$input['email'])->first();
                if($user->social_login_type == 1){
                	if(Auth::guard('customer')->loginUsingId($user->id)){
                        $url = \Session::get('locale').'/profile';
		        		return redirect()->to($url);
		        	}else{
                        $url = \Session::get('locale').'/signup';
		        		return redirect($url)->withInput()->with('error',__('index.Somthing went wrong'));
		        	}	
                }else{
                	$user->social_login_type = 1;
                	$user->google_id = $input['google_id'];
                	if($user->save()){
	                	if(Auth::guard('customer')->loginUsingId($user->id)){
                            $url = \Session::get('locale').'/profile';
			        		return redirect()->to($url);
			        	}else{
                            $url = \Session::get('locale').'/signup';
			        		return redirect($url)->withInput()->with('error',__('index.Somthing went wrong'));
			        	}
			        }else{
                        $url = \Session::get('locale').'/signup';
			        	return redirect($url)->withInput()->with('error',__('index.Somthing went wrong'));
			        }
                }
            }
            $url = \Session::get('locale').'/signup';
            return redirect($url)->withInput()->with('error',$validation->messages()->first());
            
        }else{
	        $add = User::create($input);
	        if($add){
                $logData = [
                    'user_id'           => $add->id,
                    'log_type'          => 1,
                    'login_signup_type' => 3,
                    'type'              => 2,
                    'user_status'       => $add->is_active,
                    'user_name'         => $add->firstname.' '.$add->lastname,
                    'user_number'       => $add->mobile_number,
                    'email'             => $add->email,
                ];
                CreateLogs::createLog($logData);
	        	if(Auth::guard('customer')->loginUsingId($add->id)){
                    $url = \Session::get('locale').'/reviews';
	        		return redirect()->to($url);
	        	}else{
                    $url = \Session::get('locale').'/signup';
	        		return redirect($url)->withInput()->with('error',__('index.Somthing went wrong'));
	        	}	
	        }else{
                $url = \Session::get('locale').'/signup';
	        	return redirect($url)->withInput()->with('error',__('index.Somthing went wrong'));
	        }
	    }
    }
}

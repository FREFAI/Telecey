<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Socialite,Auth;
use App\User;


class SocialAuthFacebookController extends Controller
{
    /**
       * Create a redirect method to facebook api.
       *
       * @return void
       */
        public function redirect()
        {
            return Socialite::driver('facebook')->redirect();
        }

        /**
         * Return a callback method from facebook api.
         *
         * @return callback URL from facebook
         */
        public function callback()
        {
            $user = Socialite::driver('facebook')->user();
            $password = str_random(10);
            $password = bcrypt($password);
            $userDetail = $user->user;
            if($user->email != ""){
              $userDetail['email'] = $user->email;
            }else{
              $userDetail['email'] = $userDetail['id'].'@facebook.com';
            }
            $input = [
              'email' => $userDetail['email'],
              'firstname' => $userDetail['name'],
              'facebook_id' => $userDetail['id'],
              'social_login_type' => 2,
              'password' => $password

            ];
            $validation = Validator::make($input, [
                'firstname' => 'required',
                'facebook_id' => 'required|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
            if ( $validation->fails() ) {
              if($validation->messages()->first('facebook_id')){
                  $user = User::Where('facebook_id',$input['facebook_id'])->first();
                  if(Auth::guard('customer')->loginUsingId($user->id)){
                  return redirect()->to('/profile');
                }else{
                  return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
                }
              }
              if($validation->messages()->first('email')){
                  $user = User::Where('email',$input['email'])->first();
                  if($user->social_login_type == 2){
                    if(Auth::guard('customer')->loginUsingId($user->id)){
                  return redirect()->to('/profile');
                }else{
                  return redirect('/signup')->withInput()->with('error','Somthing went wrong!');
                } 
                  }else{
                    $user->social_login_type = 2;
                    $user->facebook_id = $input['facebook_id'];
                    if($user->save()){
                      if(Auth::guard('customer')->loginUsingId($user->id)){
                    return redirect()->to('/profile');
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

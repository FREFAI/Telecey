<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\GenerateNickName;
use App\Helpers\CreateLogs;
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
        public function callback(Request $request)
        {

            try {
              if(isset($request->code)){
                $user = Socialite::driver('facebook')->user();
                $password = str_random(10);
                $password = bcrypt($password);
                $userDetail = $user->user;
                if($user->email != ""){
                  $userDetail['email'] = $user->email;
                  $input['is_active'] = 1;
                }else{
                  $userDetail['email'] = $userDetail['id'].'@facebook.com';
                }
                $firstname = mb_substr($userDetail['name'], 0, 1);
                $nickname = GenerateNickName::nickName($firstname);
                $input = [
                  'email' => $userDetail['email'],
                  'firstname' => $userDetail['name'],
                  'facebook_id' => $userDetail['id'],
                  'social_login_type' => 2,
                  'password' => $password,
                  'nickname' => $nickname

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
                        $url = '/profile';  
                        return redirect()->to($url);
                      }
                  }
                  if($validation->messages()->first('email')){
                      $user = User::Where('email',$input['email'])->first();
                      if($user->social_login_type == 2){
                        if(Auth::guard('customer')->loginUsingId($user->id)){
                          $url = '/profile';
                          return redirect()->to($url);
                        }
                      }else{
                        $user->social_login_type = 2;
                        $user->facebook_id = $input['facebook_id'];
                        if($user->save()){
                          if(Auth::guard('customer')->loginUsingId($user->id)){
                            $url = '/profile';
                            return redirect()->to($url);
                          }
                        }
                      }
                  }
                  
                }else{
                  $add = User::create($input);
                  if($add){
                    $logData = [
                        'user_id'           => $add->id,
                        'log_type'          => 1,
                        'login_signup_type' => 2,
                        'type'              => 2,
                        'user_status'       => $add->is_active,
                        'user_name'         => $add->firstname.' '.$add->lastname,
                        'user_number'       => $add->mobile_number,
                        'email'             => $add->email,
                    ];
                    CreateLogs::createLog($logData);
                    if(Auth::guard('customer')->loginUsingId($add->id)){
                      $url = '/reviews';
                      return redirect()->to($url);
                    }
                  }
                }
              }
              
            } catch (Exception $exception) {
              dd($exception->getMessage());
            }
            
        }
}

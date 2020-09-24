<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use App\User;
use App\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\GenerateNickName;
use App\Helpers\CreateLogs;
use Auth,Mail;
use App\Models\Admin\SettingsModel;





class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */
    public function signupForm(Request $request)
    {
        $setting = SettingsModel::first();
        if(!Auth::guard('customer')->check()){
            return view('FrontEnd.LoginSignup.emailsignup',['setting'=>$setting]);
        }else{
            $url = \Session::get('locale').'/profile';
            return redirect($url);
        }
        
    }
    public function signupWithFbAndGoogleForm(Request $request)
    {
        if(!Auth::guard('customer')->check()){
            return view('FrontEnd.LoginSignup.signup');
        }else{
            $url = \Session::get('locale').'/profile';
            return redirect($url);
        }
        
    }
    public function registerUser(Request $request)
    {
        if (!$request->session()->has('usersDetail')) {
            $ip = env('ip_address','live');
            if($ip == 'live'){
                $ip = $_SERVER['REMOTE_ADDR'];
            }else{
                // $ip = '2606:4580:2:0:a974:e358:829c:412e';
                $ip = '96.46.34.142';
            }
            // $ip = '96.46.34.142';
            $client = new \GuzzleHttp\Client();
            $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey","71c7f83feaa14c17bd964a3d904a1ccc").'&ip='.$ip);
            $newresponse = json_decode($newresponse->getBody());
           
            $storableLocation['city'] = $newresponse->city;
            $storableLocation['state'] = $newresponse->state_prov;
            $storableLocation['country'] = $newresponse->country_name;
            $storableLocation['country_code'] = $newresponse->country_code2;
            $storableLocation['postal_code'] = $newresponse->zipcode;
            $storableLocation['latitude'] = $newresponse->latitude;
            $storableLocation['longitude'] = $newresponse->longitude;
            $request->session()->put('usersDetail', $storableLocation); 
        }
        $usersDetailSession = $request->session()->get('usersDetail');
        
        $input = $request->all();
        
        $validation = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'checkboxTerms' => 'required',

        ]);
        if ( $validation->fails() ) {
            if($validation->messages('email')){
                return redirect()->back()->withInput()->with('error',__("index.Email already in use by another account. You can use log in or use the forgot password page to reset your password"));
            }else{
                return redirect()->back()->withInput()->with('error',$validation->messages()->first());
            }
        }else{
            $nickname = GenerateNickName::nickName($input['firstname']);
            $input['nickname'] = $nickname;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            $logData = [
                'user_id'           => $user->id,
                'log_type'          => 1,
                'login_signup_type' => 1,
                'type'              => 2,
                'user_status'       => $user->is_active,
                'user_name'         => $user->firstname.' '.$user->lastname,
                'user_number'       => $user->mobile_number,
                'email'             => $user->email,
            ];
            CreateLogs::createLog($logData);
            if($user){
                $formatted = $usersDetailSession['city'].' '.$usersDetailSession['country'].' '.$usersDetailSession['postal_code'];
                $userAddress = [
                    'user_id' => $user->id,
                    'city' => $usersDetailSession['city'],
                    'latitude' => $usersDetailSession['latitude'],
                    'longitude' => $usersDetailSession['longitude'],
                    'country' => $usersDetailSession['country'],
                    'country_code' => $usersDetailSession['country_code'],
                    'postal_code' => $usersDetailSession['postal_code'],
                    'formatted_address' => $formatted,
                    'is_primary' => 1
                ];
                UserAddress::create($userAddress);
                $id = encrypt($user->id);
                $emaildata = [
                    'id' => $id,
                    'name' => $user->firstname,
                    'email' => $user->email
                ];
                Mail::send('emailtemplates.frontend.email_verify', ['emaildata' => $emaildata] , function ($m) use ($emaildata)      {
                    $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $m->to($emaildata['email'], $emaildata['name'])->subject(__("index.Email verification"));
                });
                if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
                    $url = \Session::get('locale').'/reviews';
                   return redirect($url)->with('success',__('index.Account registered successfully'));
                }
            }else{
                return redirect()->back()->withInput()->with('error',__('index.Somthing went wrong'));
            }
        }
    }
    public function resendVerifyEmail($value='')
    {
        $user = Auth::guard('customer')->user();
        $id = encrypt($user->id);
        $emaildata = [
            'id' => $id,
            'name' => $user->firstname,
            'email' => $user->email
        ];
        Mail::send('emailtemplates.frontend.email_verify', ['emaildata' => $emaildata] , function ($m) use ($emaildata)      {
            $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $m->to($emaildata['email'], $emaildata['name'])->subject(__('index.Email verification'));
        });
        return redirect()->back();
    }
    public function confirmEmail($lan,$id)
    {
        $id = decrypt($id);
        $user = User::find($id);
        $user->is_active = 1;
        $user->email_verified_at = date("Y-m-d H:i:s");
        $logData = [
            'user_id'           => $user->id,
            'log_type'          => 2,
            'type'              => 2,
            'user_status'       => $user->is_active,
            'user_name'         => $user->firstname.' '.$user->lastname,
            'user_number'       => $user->mobile_number,
            'email'             => $user->email,
        ];
        CreateLogs::createLog($logData);
        if($user->save()){
            if (Auth::guard('customer')->loginUsingId($user->id)) {
                $url = \Session::get('locale').'/profile';
                return redirect($url)->with('success',__('index.Thank you for confirming your email address'));
            }
        }else{
            return redirect()->back()->withInput()->with('error',__('index.Somthing went wrong'));
        }
    }
}
// error_message" : "Invalid request. Invalid 'latlng' parameter
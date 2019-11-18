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
            return redirect('profile');
        }
        
    }
    public function signupWithFbAndGoogleForm(Request $request)
    {
        if(!Auth::guard('customer')->check()){
            return view('FrontEnd.LoginSignup.signup');
        }else{
            return redirect('profile');
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
                $ip = '122.173.214.129';
            }
            // $ip = '96.46.34.142';
            $data = \Location::get($ip);
          
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&latlng='.$data->latitude.','.$data->longitude);
            $response = json_decode($response->getBody());
            $storableLocation = [];
            $storableLocation['latitude'] = $data->latitude;
            $storableLocation['longitude'] = $data->longitude;
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
                return redirect()->back()->withInput()->with('error',"Email already in use by another account. You can use log in or use the forgot password page to reset your password");
            }else{
                return redirect()->back()->withInput()->with('error',$validation->messages()->first());
            }
        }else{
            $nickname = GenerateNickName::nickName($input['firstname']);
            $input['nickname'] = $nickname;
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
            if($user){
                $formatted = $usersDetailSession['city'].' '.$usersDetailSession['country'].' '.$usersDetailSession['postal_code'];
                $userAddress = [
                    'user_id' => $user->id,
                    'city' => $usersDetailSession['city'],
                    'latitude' => $usersDetailSession['latitude'],
                    'longitude' => $usersDetailSession['longitude'],
                    'country' => $usersDetailSession['country'],
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
                    $m->from('admin@telco.com', 'Telco Tales');
                    $m->to($emaildata['email'], $emaildata['name'])->subject("Email verification.");
                });
                if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
                   return redirect('/reviews')->with('success','Account registered successfully!');
                }
            }else{
                return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
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
            $m->from('admin@telco.com', 'Telco Tales');
            $m->to($emaildata['email'], $emaildata['name'])->subject("Email verification.");
        });
        return redirect()->back();
    }
    public function confirmEmail($id)
    {
        $id = decrypt($id);
        $user = User::find($id);
        $user->is_active = 1;
        $user->email_verified_at = date("Y-m-d H:i:s");
        if($user->save()){
            if (Auth::guard('customer')->loginUsingId($user->id)) {
               return redirect('/profile')->with('success','Thank you for confirming your email address');
            }
        }else{
            return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
        }
    }
}
// error_message" : "Invalid request. Invalid 'latlng' parameter
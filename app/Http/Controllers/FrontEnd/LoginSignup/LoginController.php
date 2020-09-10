<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\CreateLogs;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    public function showLoginForm()
    {
        if(!Auth::guard('customer')->check()){
            return view('FrontEnd.LoginSignup.login');
        }else{
            $url = \Session::get('locale').'/profile';
            return redirect($url);
        }
    }

    public function authenticate(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->with('error',$validation->messages()->first());
        }else{
            $dataCheck = array('email' => $input['email'],'password' => $input['password']);
            $user = User::where('email',$input['email'])->first();
            if($user){
                if(Auth::guard('customer')->attempt($dataCheck)){
                    $logData = [
                        'user_id'           => $user->id,
                        'log_type'          => 3,
                        'login_signup_type' => 1,
                        'type'              => 2,
                        'user_status'       => $user->is_active,
                        'user_name'         => $user->firstname.' '.$user->lastname,
                        'user_number'       => $user->mobile_number,
                        'email'             => $user->email,
                    ];
                    CreateLogs::createLog($logData);
                    $url = \Session::get('locale').'/profile';
                    return redirect($url)->with('success',__('index.Logged in successfully'));
                }else{
                    return redirect()->back()->with('error',__('index.Please enter valid credentials'));
                }
            }else{
                return redirect()->back()->with('error',__('index.Account not found'));
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();
        $request->session()->forget('usersDetail');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
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
            return redirect('profile');
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
                    return redirect('/profile')->with('success','Loged in successfully!');
                }else{
                    return redirect()->back()->with('error','Please enter valid credentials!');
                }
            }else{
                return redirect()->back()->with('error','Account is not found!');
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

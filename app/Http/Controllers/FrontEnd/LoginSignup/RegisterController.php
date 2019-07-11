<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\GenerateNickName;
use Auth;

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
        if(!Auth::guard('customer')->check()){
            return view('FrontEnd.LoginSignup.emailsignup');
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
        $input = $request->all();
        
        $validation = Validator::make($input, [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        if ( $validation->fails() ) {
           return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $nickname = GenerateNickName::nickName($input['firstname']);
            $input['nickname'] = $nickname;
            $input['password'] = bcrypt($input['password']);
            if(User::create($input)){
                if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
                   return redirect('/reviews')->with('success','Account registered successfully!');
                }
            }else{
                return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
            }
        }
    }
}

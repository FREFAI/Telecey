<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\FrontEnd\ResetPassword;
use App\User;
use Auth,Mail;

class ForgotPasswordController extends Controller
{
 
    public function sendEmail(Request $request)
    {
        $input = $request->all();
        
        $validation = Validator::make($input, [
            'email' => 'required|email',
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('email')){
                return redirect()->back()->withInput()->with('error',$validation->messages()->first('email'));
            }
        }else{
            $resetToken = str_random(40);
            $user = User::Where('email',$input['email'])->first();
            if($user){
                $user->password_reset = $resetToken;
                if($user->save()){
                    $emaildata = [
                        'token_link' => url('/resetPassword/'.$resetToken),
                        'user_name' => $user->firstname
                    ];
                    Mail::to($input['email'])->send(new ResetPassword($emaildata));
                    return redirect('/signin')->with('success','Check your email to reset your password!');
                }
            }else{
                return redirect()->back()->withInput()->with('error', "This email account is not registered.");
            }
        }
    }

    public function setPasswordForm($token)
    {
        $ifexist = User::where('password_reset',$token)->first();
        if($ifexist){
            return view('FrontEnd.LoginSignup.resetpassword_form',['token'=>$token]);
        }else{
            return redirect('/signin');
        }
    }
    public function setPassword(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'password' => 'required|confirmed|min:6',
            'token' => 'required'            
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->with('error', $validation->messages()->first());
        }else{
            $user = User::where('password_reset',$input['token'])->first();
            $user->password = bcrypt($input['password']);
            $user->password_reset = NULL;
            if($user->save()){
                return redirect('/signin')->with('success','Password reset successfully.');
            }else{
                return redirect()->back()->withInput()->with('error', "Somthing went wrong!");
            }
        }
    }
}

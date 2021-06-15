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
    /**
     * Forgot password form
     */
    public function forgotPasswordForm(Request $request)
    {
        if(!Auth::guard('customer')->check()){
            return view('FrontEnd.LoginSignup.forgotpassword');
        }else{
            return redirect('profile');
        }
        
    }

    /**
     * Send forgot password email to user width $resetToken
     */
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
                    $url = '/signin';
                    return redirect($url)->with('success',__('index.Check your email to reset your password'));
                }
            }else{
                return redirect()->back()->withInput()->with('error', __('index.This email account is not registered'));
            }
        }
    }

    /**
     * Set password form if token is valid
     */
    public function setPasswordForm($token)
    {
        $ifexist = User::where('password_reset',$token)->first();
        if(!Auth::guard('customer')->check()){
            if($ifexist){
                return view('FrontEnd.LoginSignup.resetpassword_form',['token'=>$token]);
            }else{
                $url = '/signin';
                return redirect($url);
            }
        }else{
            $url = '/profile';
            return redirect($url);
        }
    }
    /**
     * Set password by token
     */
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
                $url = '/signin';
                return redirect($url)->with('success',__('index.Password reset successfully'));
            }else{
                return redirect()->back()->withInput()->with('error', __('index.Somthing went wrong'));
            }
        }
    }

    /**
     * Changes password 
     */
    public function changePassword(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id'];
        $input = $request->all();
        $validation = Validator::make($input, [
            'old_password' => 'required',
            'new_password' => 'required',            
            'confirm_password' => 'required'            
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->with('error', $validation->messages()->first());
        }else{
            if (Auth::attempt(['email' => Auth::guard('customer')->user()['email'], 'password' => $input['old_password']])){
                $user = User::find($user_id);
                $user->password = bcrypt($input['new_password']);
                if($user->save()){
                    $url = '/profile';
                    return redirect($url)->with('success',__('index.Password changed successfully'));
                }else{
                    return redirect()->back()->withInput()->with('error', __('index.Somthing went wrong'));
                }
            }
            else{
                return redirect()->back()->withInput()->with('error', __("index.Invalid Old Password"));
            }
        }
    }

}

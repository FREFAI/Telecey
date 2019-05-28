<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Mail\ResetPassword;
use Mail;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('Admin.LoginSignup.forgotpassword_form');
    }
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
            $admin = AdminModel::Where('email',$input['email'])->first();
            if($admin){
                $admin->reset_password = $resetToken;
                if($admin->save()){
                    $emaildata = [
                    	'token_link' => url('/admin/resetPassword/'.$resetToken),
                    	'admin_name' => $admin->name
                    ];
                    Mail::to($input['email'])->send(new ResetPassword($emaildata));
                    return redirect('/admin/login')->with('success','Check your email to reset your password!');
                }
            }else{
                return redirect()->back()->withInput()->with('error', "This email account is not registered.");
            }
        }
    }

    public function setPasswordForm($token)
    {
    	$ifexist = AdminModel::where('reset_password',$token)->first();
    	if($ifexist){
    		return view('Admin.LoginSignup.resetpassword_form',['token'=>$token]);
    	}else{
    		return redirect('/admin/login');
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
        	$admin = AdminModel::where('reset_password',$input['token'])->first();
        	$admin->password = bcrypt($input['password']);
        	$admin->reset_password = NULL;
        	if($admin->save()){
        		return redirect('/admin/login')->with('success','Password reset successfully.');
        	}else{
        		return redirect()->back()->withInput()->with('error', "Somthing went wrong!");
        	}
        }
    }
}

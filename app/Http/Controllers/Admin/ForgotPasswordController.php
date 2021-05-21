<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Mail\ResetPassword;
use App\User;
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

    public function sendEmailManually(Request $request,$user_id)
    {
        $user_id = base64_decode($user_id);
        $resetToken = str_random(40);
        $user = User::find($user_id);
        if($user){
            $user->password_reset = $resetToken;
            if($user->save()){
                $emaildata = [
                    'token_link' => url('/resetPassword/'.$resetToken),
                    'user_name' => $user->firstname
                ];
                Mail::to($user->email)->send(new ResetPassword($emaildata));
                return redirect()->back()->with('success','Email is send');
            }else{
              return redirect()->back()->withInput()->with('error', "Email is not sent.");  
            }
        }else{
            return redirect()->back()->withInput()->with('error', "This email account is not registered.");
        }
    }

    public function showChangePasswordForm()
    {
        return view('Admin.LoginSignup.change_password');
    }
    public function changePassword(Request $request)
    {
        $admin_id = \Auth::guard('admin')->user()['id'];
        $input = $request->all();
        $validation = Validator::make($input, [
            'old_password' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',          
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->with('error', $validation->messages()->first());
        }else{
            if (\Auth::guard('admin')->attempt(['email' => \Auth::guard('admin')->user()['email'], 'password' => $input['old_password']])){
                $admin = AdminModel::find($admin_id);
                $admin->password = bcrypt($input['password']);
                if($admin->save()){
                    return redirect()->back()->with('success',__('index.Password changed successfully'));
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

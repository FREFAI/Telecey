<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Helpers\CreateLogs;
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
        return view('Admin.LoginSignup.login_form');
    }

    public function authenticate(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('email')){
                return redirect()->back()->with('error',$validation->messages()->first('email'));
            }
            if($validation->messages()->first('password')){
                return redirect()->back()->with('error',$validation->messages()->first('password'));
            }
        }else{
            $dataCheck = array('email' => $input['email'],'password' => $input['password']);
            $admin = AdminModel::where('email',$input['email'])->first();
            if($admin){
                if(Auth::guard('admin')->attempt($dataCheck)){
                    $logData = [
                        'user_id'           => $admin->id,
                        'log_type'          => 3,
                        'login_signup_type' => 1,
                        'type'              => 1,
                        'user_status'       => $admin->is_active,
                        'user_name'         => $admin->firstname.' '.$admin->lastname,
                        'email'             => $admin->email,
                    ];
                    CreateLogs::createLog($logData);
                    return redirect('/admin/dashboard')->with('success','Loged in successfully!');
                }else{
                    return redirect()->back()->with('error','Please enter valid credentials!');
                }
            }else{
                return redirect()->back()->with('error','Account is not found!');
            }
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->back();
    }
}

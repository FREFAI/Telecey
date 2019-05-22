<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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

    public function showSignupForm()
    {
        return view('Admin.LoginSignup.signup_form');
    }

    public function registerAdmin(Request $request)
    {
        $input = $request->all();
        $validation = Validator::make($input, [
            'name' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'required',
        ]);
        if ( $validation->fails() ) {
            if($validation->messages()->first('name')){
                return redirect()->back()->withInput()->with('error',$validation->messages()->first('name'));
            }
            if($validation->messages()->first('email')){
                return redirect()->back()->withInput()->with('error',$validation->messages()->first('email'));
            }
            if($validation->messages()->first('password')){
                return redirect()->back()->withInput()->with('error',$validation->messages()->first('password'));
            }
        }else{
            $input['password'] = bcrypt($input['password']);
            if(AdminModel::create($input)){
                return redirect('admin/login')->with('success','Account registered successfully!');
            }else{
                return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
            }
        }
    }
}

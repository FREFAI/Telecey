<?php

namespace App\Http\Controllers\FrontEnd\LoginSignup;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\GenerateNickName;
use Auth,Mail;

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
            $user = User::create($input);
            if($user){
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
                // if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
                   return redirect('/reviews')->with('success','Account registered successfully!');
                // }
            }else{
                return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
            }
        }
    }

    public function confirmEmail($id)
    {
        $id = decrypt($id);
        $user = User::find($id);
        $user->is_active = 1;
        $user->email_verified_at = date("Y-m-d H:i:s");
        if($user->save()){
            if (Auth::guard('customer')->loginUsingId($user->id)) {
               return redirect('/reviews')->with('success','Email verify successfully!');
            }
        }else{
            return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
        }
    }
}

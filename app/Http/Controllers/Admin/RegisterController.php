<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Models\Admin\AdminModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Helpers\CreateLogs;

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

	/**
     * Register Admins
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            $input['firstname'] = $input['name'];
            $input['password'] = bcrypt($input['password']);
            if(AdminModel::create($input)){
                return redirect('admin/login')->with('success','Account registered successfully!');
            }else{
                return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
            }
        }
    }

	/**
     * Add new Sub Admin form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerSubAdminForm(Request $request)
    {
        return view('Admin.SubAdmin.add-admin');
    }

	/**
     * Submit Sub Admin form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registerSubAdmin(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters, [
            'firstname' => 'required',
            'lastname' => 'required',
            'date_of_birth' => 'required',
            'email' => 'required|unique:admins',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $perameters['password'] = bcrypt($perameters['password']);
            $perameters['type'] = 2;
            $perameters['date_of_birth'] = \DateTime::createFromFormat('m/d/Y', $perameters['date_of_birth'])->format('Y-m-d');
            $admin = AdminModel::create($perameters);
            if($admin){
                $logData = [
                    'user_id'           => $admin->id,
                    'log_type'          => 1,
                    'login_signup_type' => 1,
                    'type'              => 1,
                    'user_status'       => 1,
                    'user_name'         => $admin->firstname.' '.$admin->lastname,
                    'email'             => $admin->email,
                ];
                CreateLogs::createLog($logData);
                return redirect('admin/admin-list')->with('success','Account registered successfully!');
            }else{
                return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
            }
        }
    }

	/**
     * Edit Sub admin form  
     * @param  \Illuminate\Http\Request  $request
     * @param  $adminID
     * @return \Illuminate\View\View
     */
    public function editSubAdminForm(Request $request,$adminID)
    {
        $adminID = base64_decode($adminID);
        $admin = AdminModel::find($adminID);
        return view('Admin.SubAdmin.edit-admin',['admin'=>$admin]);
    }

	/**
     * Submit edit sub admin form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editSubAdmin(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters, [
            'id'            => 'required',
            'firstname'     => 'required',
            'lastname'      => 'required',
            'date_of_birth' => 'required'
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $perameters['date_of_birth'] = \DateTime::createFromFormat('m/d/Y', $perameters['date_of_birth'])->format('Y-m-d');
            $id = base64_decode($perameters['id']);
            unset($perameters['id']);
            unset($perameters['_token']);
            if(AdminModel::where('id',$id)->update($perameters)){
                return redirect('admin/admin-list')->with('success','Account updated successfully!');
            }else{
                return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
            }
        }
    }

	/**
     * Delete sub admin
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSubAdmin(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters,[
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);
        }else{
            $adminID = base64_decode($perameters['id']);
            $admin = AdminModel::where('id',$adminID)->delete();
            if($admin){
                $message = array('success'=>true,'message'=>'Delete successfully.');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
    }

	/**
     * Get all sub admin list 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function subAdminList(Request $request)
    {
        $admins = AdminModel::Where('type',2)->orderBy('id','DESC')->paginate(10);
        // echo "<pre>";print_r($admins->toArray());exit;
        return view('Admin.SubAdmin.admin-list',['admins'=>$admins]);
    }

	/**
     * Approved and Un approved Sub Admin 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveOrUnapproveAdmin(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters,[
            'id'        => 'required',
            'status'    => 'required'
        ]);
        if ($validation->fails()) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);
        }else{
            $id = base64_decode($perameters['id']);
            $admin = AdminModel::find($id);
            if($admin){
                if($perameters['status'] == 1){
                    $admin->is_active = 1;
                    if($admin->save()){
                        $message = array('success'=>true,'message'=>'Approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }else{
                    $admin->is_active = 0;
                    if($admin->save()){
                        $message = array('success'=>true,'message'=>'Not approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }
            }
        }
    }
}

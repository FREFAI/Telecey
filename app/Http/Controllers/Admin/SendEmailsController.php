<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\SendEmailToUserJob;
use Mail,File;
use App\User;

class SendEmailsController extends Controller
{
    
    public function sendEmailToUsers(Request $request)
    {
        $params = $request->all();
        $params['file'] = null;
        if($request->hasFile('attached_file')){
            $attachment = $request->file('attached_file');
            // Get File name
            $attachment->getClientOriginalName();
            // Set path where you upload
            if (! File::exists(public_path()."/sendEmailToUser/")) {
                File::makeDirectory(public_path()."/sendEmailToUser/", 0777, true);
            }
            $destinationPath = public_path('/sendEmailToUser');
            // set file name
            $params['attached_file'] = $attachment->getClientOriginalName();
             // Upload images in the mentioned folder

            $attachment->move($destinationPath, $params['attached_file']);
            $params['file'] = public_path('/sendEmailToUser/'.$params['attached_file']);
        }
        foreach(explode(',',$params['ids']) as $email){
            // echo "<pre>";
            // print_r($params);
            dispatch(new SendEmailToUserJob($email,$params));
        }
        if (File::exists($params['file'])) {
            unlink($params['file']);
        }
        return json_encode(array('success'=>true, 'message'=>'Emails are send.'));
        
    }
    public function getAllEmailsOfUsers(Request $request){
        $users = User::pluck('email');
        if($users){
            return json_encode(array('success'=>true,'ids'=>$users));
        }
    }
}

<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;
use Illuminate\Support\Facades\Validator;
use App\SupportCase;
use App\SupportCaseMessage;
use Auth;
class SupportCaseController extends Controller
{
    public function index(Request $request)
    {
    	$settings = SettingsModel::first();
    	$user_id = Auth::guard('customer')->user()['id'];
		$allCases = SupportCase::where('user_id',$user_id)->orderBy('id','DESC')->paginate(10);
    	return view('FrontEnd.SupportCase.index',['settings'=> $settings,'allCases'=>$allCases]);
    }

    public function generateCase(Request $request)
    {
    	$perameters = $request->all();
    	$validation = Validator::make($perameters, [
            'subject' => 'required',
            'message' => 'required'
        ]);
        if ( $validation->fails() ) {
             return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
        	$user_id = Auth::guard('customer')->user()['id'];
        	$case = [
        		'user_id' => $user_id,
        		'subject' => $perameters['subject'],
        		'message' => $perameters['message']
        	];
        	$caseGenerate = SupportCase::create($case);
        	if($caseGenerate){
        		$message = [
        			'sender_id'   => $user_id,
        			'receiver_id' => 0,
        			'case_id'	  => $caseGenerate->id,
        			'message'	  => $perameters['message'],
        			'is_read'     => 0
        		];
        		$firstMessage = SupportCaseMessage::create($message);
        		if($firstMessage){
					return redirect()->back()->with('success','Case generate successfully.');
        		}else{
        			return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
        		}
        	}else{
				return redirect()->back()->withInput()->with('error',"Somthing went wrong!");
        	}
        }
    }

    public function caseInbox(Request $request,$caseID)
    {
    	$settings = SettingsModel::first();
    	$user_id = Auth::guard('customer')->user()['id'];
    	$caseID = base64_decode($caseID);
    	$case = SupportCase::find($caseID);
    	$caseMessages = SupportCaseMessage::where(function ($query) use ($caseID,$user_id) {
								                $query->where('sender_id',$user_id )
								                      ->orWhere('receiver_id', $user_id);
								            })->where('case_id',$caseID)->get();
    	// echo "<pre>";print_r($caseMessages);exit;
		return view('FrontEnd.SupportCase.case-inbox',['settings' => $settings,'case' => $case,'caseMessages' => $caseMessages]);
    	# code...
    }
    public function sendMessage(Request $request)
    {
    	$perameters = $request->all();
    	$user_id = Auth::guard('customer')->user()['id'];
		$perameters['case_id'] = base64_decode($perameters['case_id']);
    	$message = [
			'sender_id'   => $user_id,
			'receiver_id' => 0,
			'case_id'	  => $perameters['case_id'],
			'message'	  => $perameters['message'],
			'is_read'     => 0
		];
		$message = SupportCaseMessage::create($message);
		if($message){
			$caseStatus = SupportCase::find($perameters['case_id']);
			$caseStatus->status = 0;
			if($caseStatus->save()){
				return redirect()->back();
			}else{
				return redirect()->back();
			}
		}else{
			return redirect()->back();
		}
    }
}

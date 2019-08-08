<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SupportCaseMessage;
use App\SupportCase;
use App\User;
use Auth;
class SupportCaseController extends Controller
{
    public function index(Request $request)
    {
    	$allCase = SupportCase::orderBy('status','ASC')->paginate(10);
    	foreach ($allCase as $case) {
    		$case->user;
    	}
    	return view('Admin.CaseChat.index',['allCase'=>$allCase]);
    }

    public function searchCases(Request $request)
    {
    	// search by 0 For subject 1 for user name and 2 for user email 
    	$perameters = $request->all();
    	if($perameters['search_by'] == 0){
    		$casesList = SupportCase::where('subject','LIKE',"%{$perameters['search']}%")->paginate(10);
    	}elseif($perameters['search_by'] == 1){
    		$user_ids = User::where(function ($query) use ($perameters){
    	        $query->where('firstname','LIKE',"%{$perameters['search']}%")
    	              ->orwhere('lastname','LIKE',"%{$perameters['search']}%");
    	    })->pluck('id')->toArray();
    	    $casesList = SupportCase::whereIn('user_id',$user_ids)->paginate(10);
    	}else{
			$user_ids = User::where('email','LIKE',"%{$perameters['search']}%")->pluck('id')->toArray();
			$casesList = SupportCase::whereIn('user_id',$user_ids)->paginate(10);
    	}
    	foreach ($casesList as $case) {
    		$case->user;
    	}
    	return view('Admin.CaseChat.index',['allCase'=>$casesList,'request'=>$perameters]);
    }
    public function caseInbox(Request $request, $caseID)
    {
    	$caseID = base64_decode($caseID);
    	$case = SupportCase::find($caseID);
    	$user_id = $case->user_id;
    	$caseMessages = SupportCaseMessage::where(function ($query) use ($caseID,$user_id) {
								                $query->where('sender_id',$user_id )
								                      ->orWhere('receiver_id', $user_id);
								            })->where('case_id',$caseID)->get();
    	// echo "<pre>";print_r($caseMessages->toArray());exit;
    	return view('Admin.CaseChat.case-inbox',['case'=>$case,'caseMessages'=>$caseMessages]);
    }

    public function sendMessage(Request $request)
    {
    	$perameters = $request->all();
		$perameters['case_id'] = base64_decode($perameters['case_id']);
		$perameters['user_id'] = base64_decode($perameters['user_id']);
    	$message = [
			'sender_id'   => 0,
			'receiver_id' => $perameters['user_id'],
			'case_id'	  => $perameters['case_id'],
			'message'	  => $perameters['message'],
			'is_read'     => 0
		];
		$message = SupportCaseMessage::create($message);
		if($message){
			$caseStatus = SupportCase::find($perameters['case_id']);
			$caseStatus->status = 1;
			if($caseStatus->save()){
				return redirect()->back();
			}else{
				return redirect()->back();
			}
		}else{
			return redirect()->back();
		}
    }
    public function closeCaseRequest(Request $request)
    {
    	$perameters = $request->all();
    	$validation = Validator::make($perameters, [
            'case_id' => 'required',
            'status'  => 'required'
        ]);
        if ( $validation->fails() ) {
            $message = array('success' => false,'message'=>$validation->messages()->first() );
            return json_encode($message);
        }else{
	    	$perameters['case_id'] = base64_decode($perameters['case_id']);
	    	$caseStatus = SupportCase::find($perameters['case_id']);
			$caseStatus->status = $perameters['status'];
			if($caseStatus->save()){
				$message = array('success' => true,'message'=>"Close successfully." );
            	return json_encode($message);
			}else{
				$message = array('success' => false,'message'=>'Somthing went wrong.');
            	return json_encode($message);
			}
	    }
    }
}

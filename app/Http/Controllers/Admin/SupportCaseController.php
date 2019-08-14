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
        $current_url = \Request::getRequestUri();
        $request->session()->put('backUrlCase', $current_url);
        $parameter = $request->all();
        if(count($parameter) > 0){
            $allCase = $this->searchCases($request);
        }else{
        	$allCase = SupportCase::orderBy('status','ASC')->paginate(10);
        	foreach ($allCase as $case) {
        		$case->user;
        	}
        }
        return view('Admin.CaseChat.index',['allCase'=>$allCase,'request'=>$parameter]);
    }

    public function searchCases(Request $request)
    {
    	// search by 0 For subject 1 for user name and 2 for user email 
        $caseQuery = SupportCase::query();
    	$parameters = $request->all();
        // echo "<pre>";print_r($parameters);exit;
        if($parameters['search_by_subject'] != ''){
            $caseQuery->where('subject','LIKE',"%{$parameters['search_by_subject']}%");
        }
        if($parameters['search_by_name'] != ''){
            $user_ids_by_name = User::where(function ($query) use ($parameters){
                $query->where('firstname','LIKE',"%{$parameters['search_by_name']}%")
                      ->orwhere('lastname','LIKE',"%{$parameters['search_by_name']}%");
            })->pluck('id')->toArray();
            $caseQuery->whereIn('user_id',$user_ids_by_name);
        }
        if($parameters['search_by_email'] != ''){
            $user_ids_by_email = User::where('email','LIKE',"%{$parameters['search_by_email']}%")->pluck('id')->toArray();
            $caseQuery->whereIn('user_id',$user_ids_by_email);
        }
        if($parameters['start_date'] != '' && $parameters['end_date'] != ''){
            $parameters['start_date'] = date('Y-m-d', strtotime($parameters['start_date']));
            $parameters['end_date'] = date('Y-m-d', strtotime($parameters['end_date']));
            $caseQuery->whereBetween('created_at',[$parameters['start_date'],$parameters['end_date']]);
        }
        if($parameters['start_date'] != '' && $parameters['end_date'] == ''){
            $parameters['start_date'] = date('Y-m-d', strtotime($parameters['start_date']));
            $caseQuery->whereDate('created_at',$parameters['start_date']);
        }
        if($parameters['start_date'] == '' && $parameters['end_date'] != ''){
            $parameters['end_date'] = date('Y-m-d', strtotime($parameters['end_date']));
            $caseQuery->whereDate('created_at',$parameters['end_date']);
        }
        if($parameters['search_status'] != ""){
            $caseQuery->where('status',$parameters['search_status']);
        }
        $casesList = $caseQuery->paginate(10);
    	foreach ($casesList as $case) {
    		$case->user;
    	}
        return $casesList;
    	// return view('Admin.CaseChat.index',['allCase'=>$casesList,'request'=>$parameters]);
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

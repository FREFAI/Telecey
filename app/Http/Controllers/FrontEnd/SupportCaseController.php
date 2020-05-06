<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;
use Illuminate\Support\Facades\Validator;
use App\SupportCase;
use App\Helpers\CreateLogs;
use App\SupportCaseMessage;
use Auth,Mail;
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
        	$user = Auth::guard('customer')->user();
        	$case = [
        		'user_id' => $user_id,
        		'subject' => $perameters['subject'],
        		'message' => $perameters['message']
        	];
        	$caseGenerate = SupportCase::create($case);
        	if($caseGenerate){
				$case['name'] = $user->firstname; 
				$case['id'] = $caseGenerate->id; 
				Mail::send('emailtemplates.frontend.supportNewCase', ['caseData' => $case] , function ($m) use ($user)      {
                    $m->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $m->to($user->email, $user->firstname)->subject("New Ticket");
                });
        		$message = [
        			'sender_id'   => $user_id,
        			'receiver_id' => 0,
        			'case_id'	  => $caseGenerate->id,
        			'message'	  => $perameters['message'],
        			'is_read'     => 0
        		];
        		$firstMessage = SupportCaseMessage::create($message);
        		if($firstMessage){
					$logData = [
                        'user_id'                       => $user->id,
                        'log_type'                      => 6,
                        'type'                          => 2,
                        'user_status'                   => $user->is_active,
                        'user_name'                     => $user->firstname.' '.$user->lastname,
                        'user_number'                   => $user->mobile_number,
                        'email'                         => $user->email
					];
					CreateLogs::createLog($logData);
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
    	$case = SupportCase::where('id',$caseID)->where('user_id',$user_id)->first();
    	$caseMessages = SupportCaseMessage::where(function ($query) use ($caseID,$user_id) {
								                $query->where('sender_id',$user_id )
								                      ->orWhere('receiver_id', $user_id);
								            })->where('case_id',$caseID)->get();
    	if(!$case){
			abort(404);
		}
		return view('FrontEnd.SupportCase.case-inbox',['settings' => $settings,'case' => $case,'caseMessages' => $caseMessages]);
    }
    public function sendMessage(Request $request)
    {
		$perameters = $request->all();
    	$user_id = Auth::guard('customer')->user()['id'];
    	$user = Auth::guard('customer')->user();
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
			$logData = [
				'user_id'                       => $user->id,
				'log_type'                      => 6,
				'type'                          => 2,
				'user_status'                   => $user->is_active,
				'user_name'                     => $user->firstname.' '.$user->lastname,
				'user_number'                   => $user->mobile_number,
				'email'                         => $user->email
			];
			CreateLogs::createLog($logData);
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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\FeedbackQuestions;
use App\Models\Admin\FeedBack;
use App\Exports\FeedBackExport;
use Illuminate\Validation\Rule;
use Excel;
use App\User;

class FeedbackController extends Controller
{
    public function list(Request $request)
    {
        $questions = FeedbackQuestions::orderBy('id','DESC')->withTrashed()->paginate(10);
        return view('Admin.Feedback.list',['questions'=>$questions]);
    }

    public function add(Request $request)
    {
        return view('Admin.Feedback.add');
    }
    public function store(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters,[
            'question_name' => ['required',Rule::unique('feedback_questions')->whereNull('deleted_at')],
            'type' => 'required'
        ]);
        if($validation->fails()){
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $feedbackQuestion = FeedbackQuestions::create($perameters);
            if($feedbackQuestion){
                User::where('feedback_status',1)->update(['feedback_status'=>0]);
                return redirect('/admin/feedbackQuestion/list')->with('success','Question added successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Somthing went wrong!');
            }
        }
    }
    public function delete(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $perameter['id'] = base64_decode($perameter['id']);
            $deleteQuestion = FeedbackQuestions::findorfail($perameter['id']);
            $deleteQuestion->delete();
            if($deleteQuestion){
                $message = array(
                    'success'=>true,
                    'message'=>'Delete successfully.',
                    'deleted_at' => date("m/d/Y", strtotime($deleteQuestion->deleted_at))
                );
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
    }

    public function userFeedBackList(Request $request)
    {
        $parameter = $request->all();
        $query = FeedBack::query();
        $query->with('user');
        if(isset($parameter['start_date']) != "" && isset($parameter['end_date']) != ""){
            $parameter['start_date'] = date('Y-m-d', strtotime($parameter['start_date']));
            $parameter['end_date'] = date('Y-m-d', strtotime($parameter['end_date']));
            $query->whereBetween('created_at',[$parameter['start_date'],$parameter['end_date']]);
        }
        $feedbacks = $query->orderBy('id','DESC')->paginate(10);
        return view('Admin.Feedback.userFeedBack',['feedbacks'=>$feedbacks,'request'=>$parameter]);
    }

    public function exportFeedBack(Request $request)
    {
        $feedbacks = FeedBack::with(['user'])->orderBy('id','DESC')->get();
        $feedBackExportData = [];
        $feedBackQuestions = [];
        foreach ($feedbacks as $feedback) {
            $data=[];
            $data['email'] = $feedback->user->email;
            $data['created_at'] = $feedback->created_at;
            foreach (json_decode($feedback->feedback_rating) as $ratings) {
                if(!in_array($ratings->question_name,$feedBackQuestions)){
                    array_push($feedBackQuestions, $ratings->question_name);
                }
                $data[$ratings->question_name] = $ratings->value;
            }
            array_push($feedBackExportData,$data);
        }
        $filename = "Feedback" . date('d-m-Y');
        Excel::create($filename, function($excel) use ($feedBackQuestions,$feedBackExportData) {
            $excel->sheet('Users Feedbacks', function($sheet) use ($feedBackQuestions,$feedBackExportData)  {
                $sheet->loadView( 'exports.feedback',[
                    'feedBackQuestions' => $feedBackQuestions,
                    'feedbacks' => $feedBackExportData
                ]);
            });
        })->export('xlsx');
    }
}
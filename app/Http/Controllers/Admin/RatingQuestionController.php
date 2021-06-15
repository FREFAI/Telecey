<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\RatingQuestion;
use App\Models\FrontEnd\ServiceRating;
use Illuminate\Support\Facades\Validator;

class RatingQuestionController extends Controller
{
    
	/**
     * Get all rating questions list
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function questionList(Request $request)
    {
        $perameters = $request->all();
        $questions = RatingQuestion::query();
        if(array_key_exists('orderby',$perameters) && $perameters['orderby'] != ''){
            $field = ($perameters['orderby'] == "created_asc") || ($perameters['orderby'] == "created_desc") ? 'created_at' : "deleted_at" ;
            $order = ($perameters['orderby'] == "created_asc") || ($perameters['orderby'] == "deleted_asc") ? 'asc' : 'desc';
            $questions->orderBy($field,$order);
        }else{
            $questions->orderBy('id','DESC');
        }
        $questions = $questions->withTrashed()->paginate(10);
    	return view('Admin.RatingQuestion.question-list',['questions'=>$questions]);
    }

	/**
     * Display Add rating questions form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function addRatingQuestionForm(Request $request)
    {
    	return view('Admin.RatingQuestion.add-question');
    }

	/**
     * Submit add rating questions form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addRatingQuestion(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters,[
            'question' => 'required|unique:rating_questions',
            'type' => 'required'
        ]);
        if($validation->fails()){
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $perameters['text_field'] = isset($perameters['text_field']) ? 1 : 0;
            
            $ratingQuestion = RatingQuestion::create($perameters);
            if($ratingQuestion){
                return redirect('/admin/rating-question')->with('success','Question added successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Somthing went wrong!');
            }
        }
    }

	/**
     * Delete Question
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteRatingQuestion(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $perameter['id'] = base64_decode($perameter['id']);
            $deleteQuestion = RatingQuestion::findorfail($perameter['id']);
            $deleteQuestion->delete();
            // ServiceRating::where('question_id',$perameter['id'])->delete();
            if($deleteQuestion){
                $message = array('success'=>true,'message'=>'Delete successfully.','deleted_at' => date("m/d/Y", strtotime($deleteQuestion->deleted_at)));
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
    }
}

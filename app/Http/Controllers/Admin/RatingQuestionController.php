<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingQuestionController extends Controller
{
    
    public function questionList(Request $request)
    {
    	return view('Admin.RatingQuestion.question-list');
    }

    public function addRatingQuestionForm(Request $request)
    {
    	return view('Admin.RatingQuestion.add-question');
    }
    public function addRatingQuestion(Request $request)
    {
    	
    }
}

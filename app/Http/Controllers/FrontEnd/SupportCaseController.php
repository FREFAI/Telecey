<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;

class SupportCaseController extends Controller
{
    public function index(Request $request)
    {
    	$settings = SettingsModel::first();
    	return view('FrontEnd.SupportCase.index',['settings'=> $settings]);
    }
}

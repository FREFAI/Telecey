<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Logs;

class LogsController extends Controller
{

	/**
     * Get all logs of admin side which are generated from admin panel when superadmin or admin 
     * perfrom any action from admin panel
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function adminLog(Request $request)
    {
        $params = $request->all();
        $query = Logs::query();
        if(array_key_exists('email',$params) && $params['email'] != ""){
            $query->where('email','LIKE',"%{$params['email']}%");
        }
        if((array_key_exists('start_date',$params) && $params['start_date'] != "") && (array_key_exists('end_date',$params) && $params['end_date'] != "")){
            $date['start_date'] = date('Y-m-d', strtotime($params['start_date']));
            $date['end_date'] = date('Y-m-d', strtotime($params['end_date']));
            $query->whereBetween('created_at',[$date['start_date'],$date['end_date']]);
        }
        if(array_key_exists('type',$params) && $params['type'] != "" && $params['type'] != -1){
            $query->where('log_type',$params['type']);
        }
        $adminLogs = $query->where('type',1)->orderBy('id','DESC')->paginate(10);
        return view('Admin.Logs.adminLogs',['adminLogs'=> $adminLogs,'params'=>$params]);
    }

	/**
     * Get all logs of website side which are generated from user site when user perfrom 
     * any action from website
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function userLog(Request $request)
    {
        $params = $request->all();
        $query = Logs::query();
        if(array_key_exists('email',$params) && $params['email'] != ""){
            $query->where('email','LIKE',"%{$params['email']}%");
        }
        if((array_key_exists('start_date',$params) && $params['start_date'] != "") && (array_key_exists('end_date',$params) && $params['end_date'] != "")){
            $date['start_date'] = date('Y-m-d', strtotime($params['start_date']));
            $date['end_date'] = date('Y-m-d', strtotime($params['end_date']));
            $query->whereBetween('created_at',[$date['start_date'],$date['end_date']]);
        }
        if(array_key_exists('type',$params) && $params['type'] != "" && $params['type'] != -1){
            $query->where('log_type',$params['type']);
        }
        $userLogs = $query->where('type',2)->orderBy('id','DESC')->paginate(10);
        return view('Admin.Logs.userLogs',['userLogs'=> $userLogs,'params'=>$params]);
    }
}
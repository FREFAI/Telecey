<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Logs;

class LogsController extends Controller
{
    public function adminLog(Request $request)
    {
        $params = $request->all();
        if(count($params)>1){
            $query = \DB::table('logs');
            $query->where('type',1);
            $query->orderBy('id','DESC');
            if($params['email'] != ""){
                $query->where('email','LIKE',"%{$params['email']}%");
            }
            if($params['start_date'] != "" && $params['end_date'] != ""){
                $date['start_date'] = date('Y-m-d', strtotime($params['start_date']));
                $date['end_date'] = date('Y-m-d', strtotime($params['end_date']));
                $query->whereBetween('created_at',[$date['start_date'],$date['end_date']]);
            }
            if($params['type'] != "" && $params['type'] != -1){
                $query->where('log_type',$params['type']);
            }
            $adminLogs = $query->paginate(10);

        }else{

            $adminLogs = Logs::where('type',1)->orderBy('id','DESC')->paginate(10);
        }
        return view('Admin.Logs.adminLogs',['adminLogs'=> $adminLogs,'params'=>$params]);
    }

    public function userLog(Request $request)
    {
        $params = $request->all();
        if(count($params)>1){
            $query = \DB::table('logs');
            $query->where('type',2);
            $query->orderBy('id','DESC');
            if($params['email'] != ""){
                $query->where('email','LIKE',"%{$params['email']}%");
            }
            if($params['start_date'] != "" && $params['end_date'] != ""){
                $date['start_date'] = date('Y-m-d', strtotime($params['start_date']));
                $date['end_date'] = date('Y-m-d', strtotime($params['end_date']));
                $query->whereBetween('created_at',[$date['start_date'],$date['end_date']]);
            }
            if($params['type'] != "" && $params['type'] != -1){
                $query->where('log_type',$params['type']);
            }
            $userLogs = $query->paginate(10);

        }else{

            $userLogs = Logs::where('type',2)->orderBy('id','DESC')->paginate(10);
        }
        return view('Admin.Logs.userLogs',['userLogs'=> $userLogs,'params'=>$params]);
    }
}
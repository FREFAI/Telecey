<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ClassesModel;
use Illuminate\Support\Facades\Validator;

class ClassesController extends Controller
{
    public function index(Request $request)
    {
        $classes = ClassesModel::orderBy('id','DESC')->paginate(10);
    	return view('Admin.Classes.classes',['classes' => $classes]);
    }
    public function addClassForm(Request $request)
    {
    	return view('Admin.Classes.addClassForm');
    }
    public function addClass(Request $request)
    {
        $input = $request->all();
    	$validation = Validator::make($input,[
			'class_name' => 'required',
			'type' => 'required',
            'start_range' => 'required|numeric',
            'end_range' => 'required|numeric'

		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
            if($input['type'] == 1){
                $input['local_min'] = $input['start_range'].'-'.$input['end_range'];
                $input['local_min_start'] = $input['start_range'];
                $input['local_min_end'] = $input['end_range'];
            }elseif($input['type'] == 2){
                $input['data_volume'] = $input['start_range'].'-'.$input['end_range'];
                $input['data_volume_start'] = $input['start_range'];
                $input['data_volume_end'] = $input['end_range'];
            }
            $classData = ClassesModel::create($input);
            if($classData){
        		return redirect('/admin/classes')->withInput()->with('success','Class added successfully.');
        	}else{
        		return redirect()->back()->withInput()->with('error','Somthing went wrong!');
        	}

        }
    }
    public function editClass($id,$page)
    {
        $data = ClassesModel::find($id);
        if($data->type == 1){
            $data->start_range = $data->local_min_start; 
            $data->end_range = $data->local_min_end; 
        }else{
            $data->start_range = $data->data_volume_start; 
            $data->end_range = $data->data_volume_end; 
        }
        $data->page = $page; 
        // echo "<pre>";print_r($data);die;
    	return view('Admin.Classes.editClassForm',['data' => $data]);
    }
    public function editClassMethod(Request $request)
    {
        $input = $request->all();
    	$validation = Validator::make($input,[
			'class_name' => 'required',
			'type' => 'required',
            'start_range' => 'required|numeric',
            'end_range' => 'required|numeric'

		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
            if($input['type'] == 1){
                $input['local_min'] = $input['start_range'].'-'.$input['end_range'];
                $input['local_min_start'] = $input['start_range'];
                $input['local_min_end'] = $input['end_range'];
            }elseif($input['type'] == 2){
                $input['data_volume'] = $input['start_range'].'-'.$input['end_range'];
                $input['data_volume_start'] = $input['start_range'];
                $input['data_volume_end'] = $input['end_range'];
            }
            $id = $input['class_id'];
            $page = $input['page'];
            unset($input['_token']);
            unset($input['page']);
            unset($input['start_range']);
            unset($input['end_range']);
            unset($input['class_id']);
            $updatedData = ClassesModel::where('id',$id)->update($input);
            if($updatedData){
        		return redirect('/admin/classes?page='.$page)->withInput()->with('success','Class updated successfully.');
        	}else{
        		return redirect()->back()->withInput()->with('error','Somthing went wrong!');
        	}
        }
    }
    public function deleteClass(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);
        }else{
            $deleteType = ClassesModel::where('id',$perameter['id'])->delete();
            if($deleteType){
                $message = array('success'=>true,'message'=>'Deleted successfully');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
    }
}

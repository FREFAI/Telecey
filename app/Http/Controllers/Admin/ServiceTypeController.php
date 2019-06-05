<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\ServiceType;
use Illuminate\Support\Facades\Validator;

class ServiceTypeController extends Controller
{
        public function addServiceTypeForm(Request $request)
        {
        	return view('Admin.ServiceType.add_service_type');
        }
        public function addServiceType(Request $request)
        {
        	$perameter = $request->all();
        	$validation = Validator::make($perameter,[
    			'service_type_name' => 'required|unique:service_types',
                'type'=>'required'
    		]);
    		if($validation->fails()){
    			return redirect()->back()->with('error',$validation->messages()->first());
    		}else{
        		$serviceTypes = ServiceType::create($perameter);
        		if($serviceTypes){
        			return redirect('/admin/servicetype-list')->with('success','Service Type added successfully.');
        		}else{
        			return redirect()->back()->with('error','Somthing went wrong!');
        		}
    		}
        }

        public function editServiceTypeForm($provider_id)
        {
        	$provider_id = base64_decode($provider_id);
        	$servicetype = ServiceType::find($provider_id);
        	if($servicetype){
        		return view('Admin.ServiceType.edit_service_type',['servicetype'=>$servicetype]);
        	}else{
        		abort(404);
        	}
        }
        public function editServiceType(Request $request)
        {
        	$perameter = $request->all();
        	$validation = Validator::make($perameter,[
        		'service_type_name' => 'required|unique:service_types,service_type_name,'.$perameter['id'],
                'type' => 'required'
        	]);
        	if($validation->fails()){
    			return redirect()->back()->with('error',$validation->messages()->first());
    		}else{
	        	$provider = ServiceType::find($perameter['id']);
	        	if($provider){
	        		$provider->service_type_name = $perameter['service_type_name'];
                    $provider->type = $perameter['type'];
	        		if($provider->save()){
	        			return redirect('/admin/servicetype-list')->with('success','Service Type updated successfully.');
	        		}else{
	        			return redirect()->back()->with('error','Somthing went wrong!');
	        		}
	        	}
	        }
        }
        public function serviceTypeList(Request $request)
        {
        	$ServiceTypes = ServiceType::orderBy('id','DESC')->paginate(10);

        	return view('Admin.ServiceType.service_type_list',['serviceTypes' => $ServiceTypes]);

        }

        public function deleteServicetype(Request $request)
        {
        	$perameter = $request->all();
        	$validation = Validator::make($perameter,[
        		'id' => 'required'
        	]);
        	if ($validation->fails()) {
        		return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        	}else{
        		$deleteType = ServiceType::where('id',$perameter['id'])->delete();
        		if($deleteType){
        			$message = array('success'=>true,'message'=>'Delete successfully.');
        			return json_encode($message);
        		}else{
        			$message = array('success'=>false,'message'=>'Somthing went wrong!');
        			return json_encode($message);
        		}
        	}
        }
}

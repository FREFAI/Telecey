<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Provider;
use Illuminate\Support\Facades\Validator;

class ProviderController extends Controller
{
    public function addProviderForm(Request $request)
    {
    	return view('Admin.Providers.add_provider');
    }
    public function addProvider(Request $request)
    {
    	$perameter = $request->all();
    	$validation = Validator::make($perameter,[
			'provider_name' => 'required|unique:providers'
		]);
		if($validation->fails()){
			return redirect()->back()->with('error',$validation->messages()->first());
		}else{
    		$provider = Provider::create($perameter);
    		if($provider){
    			return redirect('/admin/provider-list')->with('success','Provider added successfully.');
    		}else{
    			return redirect()->back()->with('error','Somthing went wrong!');
    		}
		}
    }

    public function editProviderForm($provider_id)
    {
    	$provider_id = base64_decode($provider_id);
    	$provider = Provider::find($provider_id);
    	if($provider){
    		return view('Admin.Providers.edit_provider',['provider'=>$provider]);
    	}else{
    		abort(404);
    	}
    }
    public function editProvider(Request $request)
    {
    	$perameter = $request->all();
    	$validation = Validator::make($perameter,[
    		'provider_name' => 'required|unique:providers,provider_name,'.$perameter['id']
    	]);
    	$provider = Provider::find($perameter['id']);
    	if($provider){
    		$provider->provider_name = $perameter['provider_name'];
    		if($provider->save()){
    			return redirect('/admin/provider-list')->with('success','Provider updated successfully.');
    		}else{
    			return redirect()->back()->with('error','Somthing went wrong!');
    		}
    	}
    }
    public function providerList(Request $request)
    {
    	$providers = Provider::orderBy('id','DESC')->paginate(10);

    	return view('Admin.Providers.provider_list',['providers'=>$providers]);
    }
    public function deleteProvider(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $deleteType = Provider::where('id',$perameter['id'])->delete();
            if($deleteType){
                $message = array('success'=>true,'message'=>'Delete successfully.');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
    }

    public function approveProvider(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required',
            'status' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $provider = Provider::find($perameter['id']);
            if($provider){
                if($perameter['status'] == 1){
                    $provider->status = 1;
                    if($provider->save()){
                        $message = array('success'=>true,'message'=>'Approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }else{
                    $provider->status = 0;
                    if($provider->save()){
                        $message = array('success'=>true,'message'=>'Not approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Provider;
use Illuminate\Support\Facades\Validator;
use App\CountriesModel;
use App\Helpers\CreateLogs;
use File,Image;

class ProviderController extends Controller
{
    public function addProviderForm(Request $request)
    {
        $countries = CountriesModel::get();
    	return view('Admin.Providers.add_provider',['countries'=>$countries]);
    }
    public function addProvider(Request $request)
    {
        $perameter = $request->all();
    	$validation = Validator::make($perameter,[
            'provider_name' => 'required|unique:providers',
            'country' => 'required',
			'provider_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'            
		]);
		if($validation->fails()){
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
            if (! File::exists(public_path()."/providers/provider_original")) {
                File::makeDirectory(public_path()."/providers/provider_original", 0777, true);
            } 
            if (! File::exists(public_path()."/providers/provider_resized")) {
                File::makeDirectory(public_path()."/providers/provider_resized", 0777, true);
            }   
            if($request->hasFile('provider_image')){
		    	$image       = $request->file('provider_image');
                $image_file = $request->provider_image_cropped;
                list($type, $image_file) = explode(';', $image_file);
                list(, $image_file)      = explode(',', $image_file);
                $image_file = base64_decode($image_file);
                $perameter['provider_image_resize'] = time().'_provider_resized.png';
                $path = public_path('/providers/provider_resized/'.$perameter['provider_image_resize']);
                file_put_contents($path, $image_file);

	            // Original Image section 

	            $perameter['provider_image_original'] = time().'_provider_original.'.$image->getClientOriginalExtension();
	        	
	        	$image->move(public_path()."/providers/provider_original", $perameter['provider_image_original']);

	    	 	// End Original Image section
            }
            unset($perameter['provider_image_cropped']);         
            
    		$provider = Provider::create($perameter);
    		if($provider){
    			return redirect('/admin/provider-list')->with('success','Provider added successfully.');
    		}else{
    			return redirect()->back()->withInput()->with('error','Somthing went wrong!');
    		}
		}
    }

    public function editProviderForm($provider_id)
    {
    	$provider_id = base64_decode($provider_id);
        $provider = Provider::find($provider_id);
        $countries = CountriesModel::get();
    	if($provider){
    		return view('Admin.Providers.edit_provider',['provider'=>$provider,'countries'=>$countries]);
    	}else{
    		abort(404);
    	}
    }
    public function editProvider(Request $request)
    {
        $perameter = $request->all();
    	$validation = Validator::make($perameter,[
            'provider_name' => 'required|unique:providers,provider_name,'.$perameter['id'],
            'country'       => 'required',
			'provider_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'                        
        ]);
        if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
            if (! File::exists(public_path()."/providers/provider_original")) {
                File::makeDirectory(public_path()."/providers/provider_original", 0777, true);
            } 
            if (! File::exists(public_path()."/providers/provider_resized")) {
                File::makeDirectory(public_path()."/providers/provider_resized", 0777, true);
            }
    	    $provider = Provider::find($perameter['id']);
            if($provider){

                if($request->hasFile('provider_image')){
                    $image       = $request->file('provider_image');
                    $image_file = $request->provider_image_cropped;
                    list($type, $image_file) = explode(';', $image_file);
                    list(, $image_file)      = explode(',', $image_file);
                    $image_file = base64_decode($image_file);
                    $perameter['provider_image_resize'] = time().'_provider_resized.png';
                    $path = public_path('/providers/provider_resized/'.$perameter['provider_image_resize']);
                    file_put_contents($path, $image_file);
    
                    // Original Image section 
    
                    $perameter['provider_image_original'] = time().'_provider_original.'.$image->getClientOriginalExtension();
                    
                    $image->move(public_path()."/providers/provider_original", $perameter['provider_image_original']);
    
                    if($perameter['provider_image_old'] != "" && $perameter['provider_image_original_old'] != ""){
                        $oldFileOriginal = public_path()."/providers/provider_original/".$perameter['provider_image_original_old'];
                        $oldFile = public_path()."/providers/provider_resized/".$perameter['provider_image_old'];
                        if (File::exists($oldFileOriginal)) {
                            File::delete($oldFileOriginal);
                        }
                        if (File::exists($oldFile)) {
                            File::delete($oldFile);
                        }
                    }
                    
                }
                unset($perameter['provider_image_original_old']);
                unset($perameter['provider_image_old']);
                unset($perameter['provider_image_cropped']);



                
                // if($request->hasFile('provider_image')){
                //     $image       = $request->file('provider_image');
                //     $fileext    = $image->getClientOriginalExtension();
                //     $destinationPath = public_path('/providers/provider_resized');
                //     $perameter['provider_image_resize'] = time().'_provider_resized.'.$fileext;
                //     $image_resize = Image::make($image->getRealPath())->fit(540, 252, function($constraint) {
                //             $constraint->aspectRatio();
                //             $constraint->upsize();
                //             });              
                //     $image_resize->save(public_path('/providers/provider_resized/' .$perameter['provider_image_resize']));
                //     // End Resized Image section 
                //     // Original Image section 
                //     $perameter['provider_image_original'] = time().'_provider_original.'.$image->getClientOriginalExtension();
                //     $image->move(public_path()."/providers/provider_original", $perameter['provider_image_original']);
                //      // End Original Image section
                // }
                $id = $perameter['id'];
                unset($perameter['provider_image']);
                unset($perameter['_token']);
	            unset($perameter['id']);
                $edited_provider = Provider::where('id',$id)->update($perameter);
                if($edited_provider){
                    return redirect('/admin/provider-list')->with('success','Provider updated successfully.');
                }else{
                    return redirect()->back()->with('error','Somthing went wrong!');
                }
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
        $user = \Auth::guard('admin')->user();
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $provider = Provider::find($perameter['id']);
            if($provider){
                if($perameter['status'] == 1){
                    $provider->status = 1;
                    if($provider->save()){
                        $logData = [
                            'user_id'           => $user->id,
                            'log_type'          => 7,
                            'type'              => 1,
                            'user_status'       => $user->is_active,
                            'user_name'         => $user->firstname.' '.$user->lastname,
                            'email'             => $user->email,
                            'request_type'      => 1,
                            'reuqest_param_name'=> $provider->provider_name,
                            'appr_disapp_status'=> 1 
                        ];
                        CreateLogs::createLog($logData);
                        $message = array('success'=>true,'message'=>'Approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }else{
                    $provider->status = 0;
                    if($provider->save()){
                        $logData = [
                            'user_id'           => $user->id,
                            'log_type'          => 7,
                            'type'              => 1,
                            'user_status'       => $user->is_active,
                            'user_name'         => $user->firstname.' '.$user->lastname,
                            'email'             => $user->email,
                            'request_type'      => 1,
                            'reuqest_param_name'=> $provider->provider_name,
                            'appr_disapp_status'=> 0 
                        ];
                        CreateLogs::createLog($logData);
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

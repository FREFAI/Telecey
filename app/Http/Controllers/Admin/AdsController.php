<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\AdsModel;
use Illuminate\Support\Facades\Validator;
use App\CountriesModel;
use File,Image;

class AdsController extends Controller
{
    public function addAdsForm(Request $request)
    {  
		$countries = CountriesModel::get();
    	$settings = SettingsModel::first();
    	$customads = AdsModel::with('countries')->where('type',0)->paginate(10);
		$googleads = AdsModel::where('type',1)->first();
    	return view('Admin.Ads.add_ads',['countries'=>$countries,'settings'=>$settings,'customads'=>$customads,'googleads'=>$googleads]);
    }
    public function addAds(Request $request)
    {
		$input = $request->all();
    	if($input['type'] == 1){
    		$validation = Validator::make($input,[
				'script' => 'required'
    		]);
    		if ($validation->fails()) {
    			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    		}else{
    			$ads = AdsModel::where('type',1)->first();
    			if($ads){
    				$ads->script = $input['script'];
    				if($ads->save()){
    					return redirect()->back()->withInput()->with('success','Google ad update successfully.');
    				}else{
    					return redirect()->back()->withInput()->with('error','Somthing went wrong!');
    				}
    			}else{
    				$addAds = AdsModel::create($input);
    				if($addAds){
    					return redirect()->back()->withInput()->with('success','Google ad added successfully.');
    				}else{
    					return redirect()->back()->withInput()->with('error','Somthing went wrong!');
    				}
    			}
    		}
    	}else{
			if(array_key_exists('is_global',$input)){
				$input['country'] = null;
				$input['is_global'] = 1;
				$validationCiuntry = "";
			}else{
				$input['is_global'] = 0;
				$validationCiuntry = "required";
			}
    		$validation = Validator::make($input, [
	            'title' => 'required|unique:ads',
	            'ads_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
				'country' => $validationCiuntry
	        ]);
	        if ( $validation->fails() ) {
	            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
	        }else{
	        	if (!File::exists(public_path()."/ads_banner/ads_banner_original")) {
	                File::makeDirectory(public_path()."/ads_banner/ads_banner_original", 0777, true);
	            } 
	            if (!File::exists(public_path()."/ads_banner/resized")) {
	                File::makeDirectory(public_path()."/ads_banner/resized", 0777, true);
	            } 
	            // Resized Image section 
	            $image       = $request->file('ads_file');
                $fileext    = $image->getClientOriginalExtension();
                $destinationPath = public_path('/ads_banner/resized');
                $input['ads_file'] = time().'_custom_ads_resized.'.$fileext;                

                $image_resize = Image::make($image->getRealPath())->resize(320, 240, function($constraint) {
                        $constraint->aspectRatio();
                        });              
                $image_resize->save(public_path('/ads_banner/resized/' .$input['ads_file']));
	            // End Resized Image section 

	            // Original Image section 

                $input['ads_file_original'] = time().'_custom_ads_original.'.$image->getClientOriginalExtension();
	        	
	        	$image->move(public_path()."/ads_banner/ads_banner_original", $input['ads_file_original']);

        	 	// End Original Image section 

	        	$addAds = AdsModel::create($input);
	        	if($addAds){
	        		return redirect()->back()->withInput()->with('success','Custom ad added successfully.');
	        	}else{
	        		return redirect()->back()->withInput()->with('error','Somthing went wrong!');
	        	}
	        }
    	}
    }

    public function deleteAds(Request $request)
    {
    	$input = $request->all();
    	$validation = Validator::make($input,[
    		'id' => 'required'
    	]);
    	if ($validation->fails()) {
    		return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    		$deleteAdd = AdsModel::where('id',$input['id'])->delete();
    		if($deleteAdd){
    			$message = array('success'=>true,'message'=>'Delete successfully.');
    			return json_encode($message);
    		}else{
    			$message = array('success'=>false,'message'=>'Somthing went wrong!');
    			return json_encode($message);
    		}
    	}
	}
	public function approveAds(Request $request)
	{
		$perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required',
            'is_active' => 'required'
        ]);
        // $user = \Auth::guard('admin')->user();
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $ads = AdsModel::find($perameter['id']);
            if($ads){
                if($perameter['is_active'] == 1){
                    $ads->is_active = 1;
                    if($ads->save()){
                        $message = array('success'=>true,'message'=>'Approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }else{
                    $ads->is_active = 0;
                    if($ads->save()){
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

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Brands;
use App\Models\Admin\BrandModels;

class BrandsController extends Controller
{
	// Brands section 


    public function brandsList(Request $request)
    {
    	$brands = Brands::orderBy('id','DESC')->paginate(10);
    	return view('Admin.Brands.brand-list',['brands'=>$brands]);
    }
    public function addBrandForm(Request $request)
    {
    	return view('Admin.Brands.add-brand');
    }
    public function addBrand(Request $request)
    {
    	$perameters = $request->all();
    	$validation = Validator::make($perameters, [
    	    'brand_name' => 'required',
            'model_name' => 'required'
    	]);
    	if ( $validation->fails() ) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    	    $perameters['status'] = 1;
    	    unset($perameters['_token']);
    	    $addDevice = Brands::create($perameters);
    	    if($addDevice){
    	        return redirect('admin/brands-list')->withInput()->with('success','Brand and model added successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Brand and model not added.');
    	    }
    	}
    }
    public function editBrandForm(Request $request,$brandId)
    {
    	$brandId = base64_decode($brandId);
    	$brand = Brands::find($brandId);
    	return view('Admin.Brands.edit-brand',['brand'=>$brand]);
    }
    public function editBrand(Request $request)
    {
    	$perameters = $request->all();
    	$perameters['id'] = base64_decode($perameters['id']);
    	$validation = Validator::make($perameters, [
    	    'id' => 'required',
    	    'brand_name' => 'required',
            'model_name' => 'required'
    	]);
    	if ( $validation->fails() ) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    	    $editDevice = Brands::find($perameters['id']);
    	    $editDevice->brand_name = $perameters['brand_name'];
            $editDevice->model_name = $perameters['model_name'];
    	    if($editDevice->save()){
    	        return redirect('admin/brands-list')->withInput()->with('success','Brand and model updated successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Brand and model not updated.');
    	    }
    	}
    }
    public function deleteBrand(Request $request)
    {
        $perameters = $request->all();
        $perameters['id'] = base64_decode($perameters['id']);

        $validation = Validator::make($perameters, [
            'id' => 'required',
        ]);
        if ( $validation->fails() ) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);;
        }else{
            if(Brands::where('id',$perameters['id'])->delete()){
                $message = array('success'=>true,'message'=>'Brand and model delete successfully.');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Brand and model not delete.');
                return json_encode($message);
            }
        }
    }
    public function setDefaultModel(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters, [
            'id' => 'required',
            'status' => 'required',
        ]);
        if ( $validation->fails() ) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);
        }else{
            $defaultBrand = Brands::where('default',1)->first();
            if($defaultBrand){
                $defaultBrand->default = 0;
                if($defaultBrand->save()){
                    if($brand = Brands::find($perameters['id'])){
                        $brand->default = $perameters['status'];
                        if($brand->save()){
                            $message = array('success'=>true,'message'=>'Brand and model set default successfully.','status'=>$perameters['status']);
                        }else{
                            $message = array('success'=>false,'message'=>'Brand and model not set default.');
                        }
                    }else{
                        $message = array('success'=>false,'message'=>'Brand and model not set default.');
                    }
                }else{
                    $message = array('success'=>false,'message'=>'Somthing went wrong.');
                }
            }else{
                if($brand = Brands::find($perameters['id'])){
                    $brand->default = $perameters['status'];
                    if($brand->save()){
                        $message = array('success'=>true,'message'=>'Brand and model set default successfully.','status'=>$perameters['status']);
                    }else{
                        $message = array('success'=>false,'message'=>'Brand and model not set default.');
                    }
                }else{
                    $message = array('success'=>false,'message'=>'Brand and model not set default.');
                }
            }
            return json_encode($message);
            
        }
    }

    // End brand section
    
    public function approveBrand(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required',
            'status' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $brand = Brands::find($perameter['id']);
            if($brand){
                if($perameter['status'] == 1){
                    $brand->status = 1;
                    if($brand->save()){
                        $message = array('success'=>true,'message'=>'Approved successfully.');
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                    }
                }else{
                    $brand->status = 0;
                    if($brand->save()){
                        $message = array('success'=>true,'message'=>'Not approved successfully.');
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                    }
                }
                return json_encode($message);
            }

        }
    }
}

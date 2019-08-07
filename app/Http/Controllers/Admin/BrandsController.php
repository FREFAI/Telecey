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
    	$brands = Brands::withCount('brandModels')->orderBy('id','DESC')->paginate(10);
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
    	    'brand_name' => 'required|unique:brands',
    	]);
    	if ( $validation->fails() ) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    	    $perameters['status'] = 1;
    	    unset($perameters['_token']);
    	    $addDevice = Brands::create($perameters);
    	    if($addDevice){
    	        return redirect('admin/brands-list')->withInput()->with('success','Brand add successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Brand not add.');
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
    	    'brand_name' => 'required|unique:brands,brand_name,'.$perameters['id'],
    	]);
    	if ( $validation->fails() ) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    	    $editDevice = Brands::find($perameters['id']);
    	    $editDevice->brand_name = $perameters['brand_name'];
    	    if($editDevice->save()){
    	        return redirect('admin/brands-list')->withInput()->with('success','Brand update successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Brand not add.');
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
                if(BrandModels::where('brand_id',$perameters['id'])->delete()){
                    $message = array('success'=>true,'message'=>'Brand delete successfully.');
                    return json_encode($message);
                }else{
                    $message = array('success'=>false,'message'=>'Brand not delete.');
                    return json_encode($message);
                }
            }else{
                $message = array('success'=>false,'message'=>'Brand not delete.');
                return json_encode($message);
            }
        }
    }

    // End brand section

}

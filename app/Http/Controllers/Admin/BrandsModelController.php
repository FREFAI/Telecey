<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Admin\BrandModels;
class BrandsModelController extends Controller
{
    public function brandModelsList(Request $request, $brandId)
    {
    	$brandId = base64_decode($brandId);
    	$models = BrandModels::Where('brand_id',$brandId)->orderBy('id','DESC')->paginate(10);
    	return view('Admin.BrandsModel.brand-models',['models'=>$models,'brandId'=>$brandId]);
    }
    public function addBrandModelsForm(Request $request,$brandId)
    {
    	return view('Admin.BrandsModel.add-brand-model',['brandId'=>$brandId]);
    }
    public function addBrandModels(Request $request)
    {
    	$perameters = $request->all();
    	$validation = Validator::make($perameters, [
    		'brand_id' => 'required',
    	    'model_name' => 'required|unique:brand_models',
    	]);
    	$perameters['brand_id'] = base64_decode($perameters['brand_id']);
    	if ( $validation->fails() ) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    	    $perameters['status'] = 1;
    	    unset($perameters['_token']);
    	    $addDevice = BrandModels::create($perameters);
    	    if($addDevice){
    	        return redirect('admin/brand-models/'.base64_encode($perameters['brand_id']))->withInput()->with('success','Model add successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Model not add.');
    	    }
    	}
    }
    public function editBrandModelsForm(Request $request,$modelId)
    {
    	$modelId = base64_decode($modelId);
    	$model = BrandModels::find($modelId);
    	return view('Admin.BrandsModel.edit-brand-model',['model'=>$model]);
    }
    public function editBrandModels(Request $request)
    {
    	$perameters = $request->all();
    	$validation = Validator::make($perameters, [
    	    'id' => 'required',
    	    'brand_id' => 'required',
    	    'model_name' => 'required|unique:brand_models,model_name,'.$perameters['id'],
    	]);
    	if ( $validation->fails() ) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    	    $editDevice = BrandModels::find($perameters['id']);
    	    $editDevice->model_name = $perameters['model_name'];
    	    if($editDevice->save()){
    	        return redirect('admin/brand-models/'.base64_encode($perameters['brand_id']))->withInput()->with('success','Model update successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Model not add.');
    	    }
    	}
    }
    public function deleteBrandModel(Request $request)
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
            if(BrandModels::where('id',$perameters['id'])->delete()){
                $message = array('success'=>true,'message'=>'Model delete successfully.');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Model not delete.');
                return json_encode($message);
            }
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::orderBy('id','DESC')->paginate(10);
        return view('Admin.Category.index',['categories'=>$categories]);
    }
    public function addCategoryForm(Request $request)
    {
        return view('Admin.Category.add');
    }
    public function addCategory(Request $request)
    {
        $params = $request->all();
        $validation = Validator::make($params,[
			'category_name' => 'required'
		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
            $params['is_active'] = 1;
            $category = Category::create($params);
            if($category){
    	        return redirect('admin/categories')->withInput()->with('success','Category added successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Somthing went wrong!');
    	    }
        }
    }
    public function editCategoryForm(Request $request,$id)
    {
        $id = base64_decode($id);
        $category = Category::find($id);
        return view('Admin.Category.edit',['category'=>$category]);
    }
    public function editCategory(Request $request)
    {
        $params = $request->all();

        $params['id']= base64_decode($params['id']);
    	$validation = Validator::make($params, [
    	    'id' => 'required',
    	    'category_name' => 'required|unique:categories,category_name,'.$params['id'],
    	]);
    	if ( $validation->fails() ) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    	    $editCategory = Category::find($params['id']);
    	    $editCategory->category_name = $params['category_name'];
    	    if($editCategory->save()){
    	        return redirect('admin/categories')->withInput()->with('success','Category updated successfully.');
    	    }else{
    	        return redirect()->back()->withInput()->with('error','Somthing went wrong!');
    	    }
    	}
    }
    public function deleteCategory(Request $request)
    {
        $params = $request->all();
        $params['id'] = base64_decode($params['id']);

        $validation = Validator::make($params, [
            'id' => 'required',
        ]);
        if ( $validation->fails() ) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);
        }else{
            if(Category::where('id',$params['id'])->delete()){
                $message = array('success'=>true,'message'=>'Category delete successfully.');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Somthing went wrong!');
                return json_encode($message);
            }
        }
    }
}

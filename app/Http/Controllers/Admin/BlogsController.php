<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\BlogsModel;
use Illuminate\Support\Facades\Validator;
use File,Image;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
    	$blogs = BlogsModel::orderBy('id','DESC')->paginate(10);
    	return view('Admin.Blogs.blog-list',['blogs' => $blogs]);
    }

    public function addBlogForm(Request $request)
    {
    	return view('Admin.Blogs.add-blog');
    }
    public function addBlog(Request $request)
    {
    	$perameters = $request->all();
    	$validation = Validator::make($perameters,[
			'title' => 'required',
			'blog_content' => 'required',
			'blog_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
			if (! File::exists(public_path()."/blogs/blog_original")) {
                File::makeDirectory(public_path()."/blogs/blog_original", 0777, true);
            } 
            if (! File::exists(public_path()."/blogs/resized")) {
                File::makeDirectory(public_path()."/blogs/resized", 0777, true);
            } 
            if($request->hasFile('blog_picture')){
		    	$image       = $request->file('blog_picture');
	            $fileext    = $image->getClientOriginalExtension();
	            $destinationPath = public_path('/blogs/resized');
	            $perameters['blog_picture'] = time().'_blog_resized.'.$fileext;                

	            $image_resize = Image::make($image->getRealPath())->resize(540, 252, function($constraint) {
	                    $constraint->aspectRatio();
	                    $constraint->upsize();
	                    });              
	            $image_resize->save(public_path('/blogs/resized/' .$perameters['blog_picture']));
	            // End Resized Image section 

	            // Original Image section 

	            $perameters['blog_picture_original'] = time().'_blog_original.'.$image->getClientOriginalExtension();
	        	
	        	$image->move(public_path()."/blogs/blog_original", $perameters['blog_picture_original']);

	    	 	// End Original Image section
            }
	    	 

        	$blogs = BlogsModel::create($perameters);
        	if($blogs){
        		return redirect('/admin/blogs')->withInput()->with('success','Blog added successfully.');
        	}else{
        		return redirect()->back()->withInput()->with('error','Somthing went wrong!');
        	}
		}
    }

    public function editBlogForm(Request $request,$id)
    {
    	$id = base64_decode($id);
    	$blog = BlogsModel::find($id);
    	return view('Admin.Blogs.edit-blog',['blog'=>$blog]);
    }
    public function editBlog(Request $request)
    {
    	$perameters = $request->all();

    	$validation = Validator::make($perameters,[
    		'id'=> 'required',
			'title' => 'required',
			'blog_content' => 'required',
			'blog_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
			if (! File::exists(public_path()."/blogs/blog_original")) {
                File::makeDirectory(public_path()."/blogs/blog_original", 0777, true);
            } 
            if (! File::exists(public_path()."/blogs/resized")) {
                File::makeDirectory(public_path()."/blogs/resized", 0777, true);
            } 
            $id = base64_decode($perameters['id']);
            $blog = BlogsModel::find($id);
       
            if($blog){
	            if($request->hasFile('blog_picture')){
			    	$image       = $request->file('blog_picture');
		            $fileext    = $image->getClientOriginalExtension();
		            $destinationPath = public_path('/blogs/resized');
		            $perameters['blog_picture'] = time().'_blog_resized.'.$fileext;                

		            $image_resize = Image::make($image->getRealPath())->resize(540, 252, function($constraint) {
		                    $constraint->aspectRatio();
		                    $constraint->upsize();
		                    });              
		            $image_resize->save(public_path('/blogs/resized/' .$perameters['blog_picture']));
		            // End Resized Image section 

		            // Original Image section 

		            $perameters['blog_picture_original'] = time().'_blog_original.'.$image->getClientOriginalExtension();
		        	
		        	$image->move(public_path()."/blogs/blog_original", $perameters['blog_picture_original']);

		    	 	// End Original Image section
	            }
		    	 
	            unset($perameters['id']);
	            unset($perameters['_token']);
	        	$blogs = BlogsModel::where('id',$id)->update($perameters);
	        	if($blogs){
	        		return redirect('/admin/blogs')->withInput()->with('success','Blog updated successfully.');
	        	}else{
	        		return redirect()->back()->withInput()->with('error','Somthing went wrong!');
	        	}
            }
           
		}
    }
    public function deleteBlog(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $deleteType = BlogsModel::where('id',$perameter['id'])->delete();
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

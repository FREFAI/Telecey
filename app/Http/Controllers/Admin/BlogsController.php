<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin\Category;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\BlogsModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use File,Image,Mail;

class BlogsController extends Controller
{
    public function index(Request $request)
    {
    	$blogs = BlogsModel::orderBy('id','DESC')->paginate(10);
    	return view('Admin.Blogs.blog-list',['blogs' => $blogs]);
    }

    public function addBlogForm(Request $request)
    {
        $categories = Category::get();
        $setting  = SettingsModel::first();
    	return view('Admin.Blogs.add-blog',['categories'=>$categories,'setting'=>$setting]);
    }
    public function addBlog(Request $request)
    {
        $perameters = $request->all();
        $setting  = SettingsModel::first();
        if($setting){
            $size = $setting->blog_image_limit * 1024;
        }else{
            $size = 10240;
        }
    	$validation = Validator::make($perameters,[
			'title' => 'required',
			'category_id' => 'required',
			'blog_content' => 'required',
			'blog_picture' => 'mimes:jpeg,png,jpg,gif,svg|max:'.$size
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
                $image_file = $request->blog_image;
                list($type, $image_file) = explode(';', $image_file);
                list(, $image_file)      = explode(',', $image_file);
                $image_file = base64_decode($image_file);
                $perameters['blog_picture'] = time().'_blog_resized.png';
                $path = public_path('/blogs/resized/'.$perameters['blog_picture']);
                file_put_contents($path, $image_file);

	            // Original Image section 

	            $perameters['blog_picture_original'] = time().'_blog_original.'.$image->getClientOriginalExtension();
	        	
	        	$image->move(public_path()."/blogs/blog_original", $perameters['blog_picture_original']);

	    	 	// End Original Image section
            }
            unset($perameters['blog_image']);
	    	 

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
        $categories = Category::get();
        $setting  = SettingsModel::first();
    	return view('Admin.Blogs.edit-blog',['blog'=>$blog,'categories'=>$categories,'setting'=>$setting]);
    }
    public function editBlog(Request $request)
    {
    	$perameters = $request->all();
        $setting  = SettingsModel::first();
        if($setting){
            $size = $setting->blog_image_limit * 1024;
        }else{
            $size = 10240;
        }
    	$validation = Validator::make($perameters,[
    		'id'=> 'required',
			'title' => 'required',
			'category_id' => 'required',
			'blog_content' => 'required',
			'blog_picture' => 'mimes:jpeg,png,jpg,gif,svg|max:'.$size
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
                    $image_file = $request->blog_image;
                    list($type, $image_file) = explode(';', $image_file);
                    list(, $image_file)      = explode(',', $image_file);
                    $image_file = base64_decode($image_file);
                    $perameters['blog_picture'] = time().'_blog_resized.png';
                    $path = public_path('/blogs/resized/'.$perameters['blog_picture']);
                    file_put_contents($path, $image_file);
    
                    // Original Image section 
    
                    $perameters['blog_picture_original'] = time().'_blog_original.'.$image->getClientOriginalExtension();
                    
                    $image->move(public_path()."/blogs/blog_original", $perameters['blog_picture_original']);
    
                    if($perameters['blog_image_old'] != "" && $perameters['blog_image_original_old'] != ""){
                        $oldFileOriginal = public_path()."/blogs/blog_original/".$perameters['blog_image_original_old'];
                        $oldFile = public_path()."/blogs/resized/".$perameters['blog_image_old'];
                        if (File::exists($oldFileOriginal)) {
                            File::delete($oldFileOriginal);
                        }
                        if (File::exists($oldFile)) {
                            File::delete($oldFile);
                        }
                    }
                    
                }
                unset($perameters['blog_image_original_old']);
                unset($perameters['blog_image_old']);
                unset($perameters['blog_image']);

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


    public function viewBlog(Request $request,$id)
    {
        $id = base64_decode($id);
        $blog = BlogsModel::find($id);
        return view('Admin.Blogs.view-blog',['blog'=>$blog]);
    }
    public function deleteBlog(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required'
        ]);
        if ($validation->fails()) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);
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
	

    public function approveBlog(Request $request)
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
           
            $blog = BlogsModel::with('user')->find($perameter['id']);
            if($blog){
                $emaildata = [
                    "is_exist" => $blog->user ? 1 : 0,
                    "email" => $blog->user ? $blog->user->email : "",
                    "name" =>  $blog->user ? $blog->user->firstname : "",
                    "blog_id" =>  $blog->id,
                    "blog_title" =>  $blog->title,
                ];
                if($perameter['status'] == 1){
                    $blog->status = 1;

                    if($blog->save()){
                        if($emaildata['is_exist']){
                            Mail::send('emailtemplates.admin.blog_approved', ['emaildata' => $emaildata] , function ($m) use ($emaildata)      {
                                $m->from('admin@telco.com', 'Telco Tales');
                                $m->to($emaildata['email'], $emaildata['name'])->subject("Artical published");
                            });
                        }
                        $message = array('success'=>true,'message'=>'Approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }else{
                    $blog->status = 0;
                    if($blog->save()){
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

<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Category;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\SettingsModel;
use Auth,File,Image;

class BlogsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $settings = SettingsModel::first();
        view()->composer('layouts/frontend_layouts/header', function($view) use ($settings) {
            $view->with('settings', $settings);
        });
    }
    
    /**
     * Get Blog list
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blogs(Request $request)
    {
        $params = $request->all();
        $query = BlogsModel::query();
        $query->orderBy('created_at','DESC')->where('status',1);
        if(array_key_exists('search',$params)){
            if($params['search'] != ""){
                $query->where('title','LIKE',"%{$params['search']}%")->orwhere('blog_content','LIKE',"%{$params['search']}%");
            }
        }
        $blogs = $query->paginate(10);
        return view('FrontEnd.blogs',['blogs'=>$blogs,'params'=>$params]);
    }

    /**
     * Add new blog form
     */
    public function addBlogForm()
    {
		$categories = Category::get();
        $setting  = SettingsModel::first();
        return view('FrontEnd.Blogs.addBlog',['categories'=>$categories,'setting'=>$setting]);
    }

    /**
     * Add new blog from user
     */
    public function addBlog(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        $perameters = $request->all();
        $setting  = SettingsModel::first();
        if($setting){
            $size = $setting->blog_image_limit * 1024;
        }else{
            $size = 10000;
        }
    	$validation = Validator::make($perameters,[
			'title' => 'required',
			'category_id' => 'required',
			'blog_content' => 'required',
			'blog_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:'.$size 
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

	            $image_resize = Image::make($image->getRealPath())->fit(540, 252, function($constraint) {
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

            $perameters['status'] = 0;
            $perameters['user_id'] = $user_id;

            $blogs = BlogsModel::create($perameters);
            
        	if($blogs){
                $url = '/blog-list';
        		return redirect($url)->withInput()->with('success',__('index.Blog added successfully'));
        	}else{
        		return redirect()->back()->withInput()->with('error',__('index.Somthing went wrong'));
        	}
		}
    }
    /**
     * Edit blog form
     */
    public function editBlogForm($id)
    {
        $id = base64_decode($id);
        $categories = Category::get();
        $blog = BlogsModel::find($id);
        $setting  = SettingsModel::first();
        return view('FrontEnd.Blogs.editBlog',['categories'=>$categories,'blog'=>$blog,'setting'=>$setting]);
    }

    /**
     * Edit blog from user
     */
    public function editBlog(Request $request)
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        $perameters = $request->all();
        $setting  = SettingsModel::first();
        if($setting){
            $size = $setting->blog_image_limit * 1024;
        }else{
            $size = 10000;
        }
    	$validation = Validator::make($perameters,[
    		'id'=> 'required',
			'title' => 'required',
			'category_id' => 'required',
			'blog_content' => 'required',
			'blog_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:'.$size
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

		            $image_resize = Image::make($image->getRealPath())->fit(540, 252, function($constraint) {
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
                    $url = '/blog-list';
	        		return redirect($url)->withInput()->with('success',__('index.Blog updated successfully'));
	        	}else{
	        		return redirect()->back()->withInput()->with('error',__('index.Somthing went wrong'));
	        	}
            }
           
		}
    }

    /**
     * Get blogs of current user
     */
    public function blogList()
    {
        $user_id = Auth::guard('customer')->user()['id']; 
        $blogs = BlogsModel::orderBy('created_at','DESC')->where('user_id',$user_id)->paginate(10);
        return view('FrontEnd.Blogs.blogList',['blogs'=>$blogs]);
    }
    /**
     * Delete blog
     */
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
                $message = array('success'=>true,'message'=>__('index.Delete successfully'));
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>__('index.Somthing went wrong'));
                return json_encode($message);
            }
        }
    }

    /**
     * Get Blog detail
     */
    public function blogDetail($id)
    {
        $id = base64_decode($id);
        $blog = BlogsModel::with('category')->find($id);
        return view('FrontEnd.Blogs.view',['blog'=>$blog]);
    }
}

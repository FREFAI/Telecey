<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\HomeContent;
use Illuminate\Support\Facades\Validator;
use File,Image;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $homeContent = HomeContent::first();
        $setting  = SettingsModel::first();
        $homeContent->section_six = json_decode($homeContent->section_six);
        // echo "<pre>";
        // print_r($homeContent);
        // exit;
    	return view('Admin.Home.index',['homeContent'=>$homeContent,'setting'=>$setting]);
    }
    public function sectionOne(Request $request)
    {
        $params = $request->all();
        // echo "<pre>";
        // print_r($params);
        // exit;
        $setting  = SettingsModel::first();
        if($setting){
            $size = $setting->homepage_images_limit * 1024;
        }else{
            $size = 10240;
        }
        $validation = Validator::make($params,[
            'section_one' => 'required',
            'section_one_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:'.$size
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            if (!File::exists(public_path()."/home/images")) {
                File::makeDirectory(public_path()."/home/images", 0777, true);
            } 
            // Resized Image section 
            if($request->hasFile('section_one_image')){
                $image_file = $request->section_one_image_croped;
                list($type, $image_file) = explode(';', $image_file);
                list(, $image_file)      = explode(',', $image_file);
                $image_file = base64_decode($image_file);
                $params['section_one_image'] = time().'_home_image.png';
                $path = public_path('/home/images/'.$params['section_one_image']);
                file_put_contents($path, $image_file);

                // $image       = $request->file('section_one_image');
                // $fileext    = $image->getClientOriginalExtension();
                // $destinationPath = public_path('/home/images');
                // $params['section_one_image'] = time().'_home_image.'.$fileext;    
                // $destinationPath = public_path('/home/images');
                // $image->move($destinationPath, $params['section_one_image']);
                
                // $image_resize = Image::make($image->getRealPath())->resize(524, 524, function($constraint) {
                //     $constraint->aspectRatio();
                // });              
                // $image_resize->save(public_path('/home/images/' .$params['section_one_image']));
                if($params['section_one_image_old'] != ""){
                    $oldFile = public_path()."/home/images/".$params['section_one_image_old'];
                    if (File::exists($oldFile)) {
                        File::delete($oldFile);
                    }
                }
                unset($params['section_one_image_old']);
            }
            unset($params['section_one_image_croped']);
            // echo "<pre>";
            // print_r($params);
            // exit;
            $homeContentData = HomeContent::first();
            if($homeContentData == null){
                $saveContent = HomeContent::create($params);
                if($saveContent){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }else{
                $homeContentData->section_one = $params['section_one'];
                $homeContentData->section_one_image_link = $params['section_one_image_link'];
                $homeContentData->section_one_image_border_color = $params['section_one_image_border_color'];
                if($request->hasFile('section_one_image')){
                    $homeContentData->section_one_image = $params['section_one_image'];
                }
                if($homeContentData->save()){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }
        }
    }
    public function sectionTwo(Request $request)
    {
        $params = $request->all();
        $validation = Validator::make($params,[
            'section_two' => 'required',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            
            $homeContentData = HomeContent::first();
            if($homeContentData == null){
                $saveContent = HomeContent::create($params);
                if($saveContent){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }else{
                $homeContentData->section_two = $params['section_two'];
                if($homeContentData->save()){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }
        }
    }
    
    public function sectionThree(Request $request)
    {
        $params = $request->all();
        $validation = Validator::make($params,[
            'section_three' => 'required',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            
            $homeContentData = HomeContent::first();
            if($homeContentData == null){
                $saveContent = HomeContent::create($params);
                if($saveContent){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }else{
                $homeContentData->section_three = $params['section_three'];
                if($homeContentData->save()){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }
        }
    }
    public function sectionFour(Request $request)
    {
        $params = $request->all();
        $setting  = SettingsModel::first();
        if($setting){
            $size = $setting->homepage_images_limit * 1024;
        }else{
            $size = 10240;
        }
        $validation = Validator::make($params,[
            'section_four' => 'required',
            'section_four_description' => 'required',
            'section_four_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:'.$size
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            if (!File::exists(public_path()."/home/images")) {
                File::makeDirectory(public_path()."/home/images", 0777, true);
            } 
            // Resized Image section 
            if($request->hasFile('section_four_image')){
                $image       = $request->file('section_four_image');
                $fileext    = $image->getClientOriginalExtension();
                $destinationPath = public_path('/home/images');
                $params['section_four_image'] = time().'_home_image_section_four.'.$fileext;                

                $image_resize = Image::make($image->getRealPath())->resize(361, 231, function($constraint) {
                    $constraint->aspectRatio();
                });              
                $image_resize->save(public_path('/home/images/' .$params['section_four_image']));
                if($params['section_four_image_old'] != ""){
                    $oldFile = public_path()."/home/images/".$params['section_four_image_old'];
                    if (File::exists($oldFile)) {
                        File::delete($oldFile);
                    }
                }
                unset($params['section_four_image_old']);
            }
            $homeContentData = HomeContent::first();
            if($homeContentData == null){
                $saveContent = HomeContent::create($params);
                if($saveContent){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }else{
                $homeContentData->section_four = $params['section_four'];
                $homeContentData->section_four_image_link = $params['section_four_image_link'];
                $homeContentData->section_four_description = $params['section_four_description'];
                if($request->hasFile('section_four_image')){
                    $homeContentData->section_four_image = $params['section_four_image'];
                }
                if($homeContentData->save()){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }
        }
    }
    
    public function sectionFive(Request $request)
    {
        $params = $request->all();
        $validation = Validator::make($params,[
            'section_five' => 'required',
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            
            $homeContentData = HomeContent::first();
            if($homeContentData == null){
                $saveContent = HomeContent::create($params);
                if($saveContent){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }else{
                $homeContentData->section_five = $params['section_five'];
                if($homeContentData->save()){
                    return redirect()->back()->withInput()->with('success','Content save successfully.');
                }else{
                    return redirect()->back()->withInput()->with('error','Somthing went wrong!');
                }
            }
        }
    }

    public function sectionSix(Request $request)
    {
        $params = $request->all();
        unset($params['_token']);
        // echo "<pre>";
        // print_r($params);
        // exit;
        $homeContentData = HomeContent::first();
        if($homeContentData == null){
            for ($i=1; $i <= 6; $i++) {
                if(array_key_exists('icon_'.$i,$params)){
                    if (!File::exists(public_path()."/home/images")) {
                        File::makeDirectory(public_path()."/home/images", 0777, true);
                    } 
                    // Resized Image section 
                    if($request->hasFile('icon_'.$i)){
                        $image       = $request->file('icon_'.$i);
                        $fileext    = $image->getClientOriginalExtension();
                        $destinationPath = public_path('/home/images');
                        $params['icon_'.$i] = uniqid().time().'_home_image_section_four.'.$fileext;                
        
                        $image_resize = Image::make($image->getRealPath())->resize(65, 65, function($constraint) {
                            $constraint->aspectRatio();
                        });              
                        $image_resize->save(public_path('/home/images/' .$params['icon_'.$i]));
                        
                    }
                }else{
                        $params['icon_'.$i] = '';
                }  
            }
            $data['section_six'] = json_encode($params);
            $saveContent = HomeContent::create($data);
            if($saveContent){
                return redirect()->back()->withInput()->with('success','Content save successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Somthing went wrong!');
            }
        }else{
            for ($i=1; $i <= 6; $i++) {
                if(array_key_exists('icon_'.$i,$params)){
                    if (!File::exists(public_path()."/home/images")) {
                        File::makeDirectory(public_path()."/home/images", 0777, true);
                    } 
                    // Resized Image section 
                    if($request->hasFile('icon_'.$i)){
                        $image       = $request->file('icon_'.$i);
                        $fileext    = $image->getClientOriginalExtension();
                        $destinationPath = public_path('/home/images');
                        $params['icon_'.$i] = uniqid().time().'_home_image_section_four.'.$fileext;                
        
                        $image_resize = Image::make($image->getRealPath())->resize(65, 65, function($constraint) {
                            $constraint->aspectRatio();
                        });              
                        $image_resize->save(public_path('/home/images/' .$params['icon_'.$i]));
                        
                    }
                }else{
                    if($homeContentData->section_six != ""){
                        $home_six = json_decode($homeContentData->section_six);
                        $index = 'icon_'.$i;
                        $params['icon_'.$i] = $home_six->$index;
                    }else{
                        $params['icon_'.$i] = '';
                    }
                   
                } 
            }
            $params = json_encode($params);
            $homeContentData->section_six =  $params;
            if($homeContentData->save()){
                return redirect()->back()->withInput()->with('success','Content save successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Somthing went wrong!');
            }
        }
    }
    
    public function termsAndConditionsForm(Request $request)
    {
        $setting = SettingsModel::first();
    	return view('Admin.Home.terms-conditions',['setting'=>$setting]);
    }
    
    public function termsAndConditions(Request $request)
    {
        $params = $request->all();
        $setting = SettingsModel::first();
        $setting->terms_and_conditions = $params['terms_condition'];
        if($setting->save()){
            return redirect()->back()->withInput()->with('success','Terms and conditions update successfully.');
        }else{
            return redirect()->back()->withInput()->with('error','Somthing went wrong!');
        }
        
        

    }
}

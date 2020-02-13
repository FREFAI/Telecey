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
    	return view('Admin.Home.index',['homeContent'=>$homeContent]);
    }
    public function sectionOne(Request $request)
    {
        $params = $request->all();
        $validation = Validator::make($params,[
            'section_one' => 'required',
            'section_one_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            if (!File::exists(public_path()."/home/images")) {
                File::makeDirectory(public_path()."/home/images", 0777, true);
            } 
            // Resized Image section 
            if($request->hasFile('section_one_image')){
                $image       = $request->file('section_one_image');
                $fileext    = $image->getClientOriginalExtension();
                $destinationPath = public_path('/home/images');
                $params['section_one_image'] = time().'_home_image.'.$fileext;                

                $image_resize = Image::make($image->getRealPath())->resize(524, 524, function($constraint) {
                    $constraint->aspectRatio();
                });              
                $image_resize->save(public_path('/home/images/' .$params['section_one_image']));
                if($params['section_one_image_old'] != ""){
                    $oldFile = public_path()."/home/images/".$params['section_one_image_old'];
                    if (File::exists($oldFile)) {
                        File::delete($oldFile);
                    }
                }
                unset($params['section_one_image_old']);
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
                $homeContentData->section_one = $params['section_one'];
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
    public function sectionFour(Request $request)
    {
        $params = $request->all();
        $validation = Validator::make($params,[
            'section_four' => 'required',
            'section_four_description' => 'required',
            'section_four_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000'
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

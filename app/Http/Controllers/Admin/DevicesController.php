<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Devices;
use App\Models\Admin\DeviceColor;

class DevicesController extends Controller
{

	/**
     * Get all devices from database 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function devicesList(Request $request)
    {
        $devices = Devices::orderBy('id','DESC')->paginate(10);
    	return view('Admin.Devices.device-list',['devices'=>$devices]);
    }


    /**
     * Display Add device form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function addDevicesForm(Request $request)
    {
    	return view('Admin.Devices.add-device');
    }

    /**
     * Submit Add device form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addDevices(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters, [
            'device_name' => 'required|unique:devices',
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $perameters['status'] = 1;
            unset($perameters['_token']);
            $addDevice = Devices::create($perameters);
            if($addDevice){
                return redirect('admin/devices-list')->withInput()->with('success','Device add successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Device not add.');
            }
        }
    }

	/**
     * Display Edit device form 
     * @param  \Illuminate\Http\Request  $request
     * @param  $deviceId
     * @return \Illuminate\View\View
     */
    public function editDevicesForm(Request $request,$deviceId)
    {
        $deviceId = base64_decode($deviceId);
        $device = Devices::find($deviceId);
        return view('Admin.Devices.edit-device',['device' => $device]);
    }

	/**
     * Submit edit device form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editDevices(Request $request)
    {
        $perameters = $request->all();
        $perameters['id'] = base64_decode($perameters['id']);
        $validation = Validator::make($perameters, [
            'id' => 'required',
            'device_name' => 'required|unique:devices,device_name,'.$perameters['id'],
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $editDevice = Devices::find($perameters['id']);
            $editDevice->device_name = $perameters['device_name'];
            if($editDevice->save()){
                return redirect('admin/devices-list')->withInput()->with('success','Device update successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Device not add.');
            }
        }
    }

	/**
     * Delete device 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteDevices(Request $request)
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
            if(Devices::where('id',$perameters['id'])->delete()){
                $message = array('success'=>true,'message'=>'Device delete successfully.');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Device not delete.');
                return json_encode($message);
            }
        }
    }

	/**
     * Set default device 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setDefaultDevice(Request $request)
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
            $defaultBrand = Devices::where('default',1)->first();
            if($defaultBrand){
                $defaultBrand->default = 0;
                if($defaultBrand->save()){
                    if($brand = Devices::find($perameters['id'])){
                        $brand->default = $perameters['status'];
                        if($brand->save()){
                            $message = array('success'=>true,'message'=>'Device set default successfully.','status'=>$perameters['status']);
                        }else{
                            $message = array('success'=>false,'message'=>'Device not set default.');
                        }
                    }else{
                        $message = array('success'=>false,'message'=>'Device not set default.');
                    }
                }else{
                    $message = array('success'=>false,'message'=>'Somthing went wrong.');
                }
            }else{
                if($brand = Devices::find($perameters['id'])){
                    $brand->default = $perameters['status'];
                    if($brand->save()){
                        $message = array('success'=>true,'message'=>'Device set default successfully.','status'=>$perameters['status']);
                    }else{
                        $message = array('success'=>false,'message'=>'Device not set default.');
                    }
                }else{
                    $message = array('success'=>false,'message'=>'Device not set default.');
                }
            }
            return json_encode($message);
            
        }
    }


    // Device Color Section 
    
	/**
     * Get all devices color from database 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deviceColorList(Request $request)
    {
        $colors = DeviceColor::orderBy('id','DESC')->paginate(10);
        return view('Admin.Devices.color.color-list',['colors'=>$colors]);
    }

    /**
     * Display Add device color form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function addColorForm(Request $request)
    {
        return view('Admin.Devices.color.add-device-color');
    }

    /**
     * Submit Add device color form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function addColor(Request $request)
    {
        $perameters = $request->all();
        $validation = Validator::make($perameters, [
            'color_name' => 'required|unique:device_colors',
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            unset($perameters['_token']);
            $addColor = DeviceColor::create($perameters);
            if($addColor){
                return redirect('admin/colors-list')->withInput()->with('success','Color add successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Color not add.');
            }
        }
    }

    /**
     * Display Edit device color form 
     * @param  \Illuminate\Http\Request  $request
     * @param  $id
     * @return \Illuminate\View\View
     */
    public function editColorForm(Request $request,$id)
    {
        $id = base64_decode($id);
        $color = DeviceColor::find($id);
        return view('Admin.Devices.color.edit-device-color',['color'=>$color]);
    }

    
	/**
     * Submit edit device color form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editColor(Request $request)
    {
        $perameters = $request->all();
        $perameters['id'] = base64_decode($perameters['id']);
        $validation = Validator::make($perameters, [
            'id' => 'required',
            'color_name' => 'required|unique:device_colors,color_name,'.$perameters['id'],
        ]);
        if ( $validation->fails() ) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $editColor = DeviceColor::find($perameters['id']);
            $editColor->color_name = $perameters['color_name'];
            if($editColor->save()){
                return redirect('admin/colors-list')->withInput()->with('success','Color update successfully.');
            }else{
                return redirect()->back()->withInput()->with('error','Color not add.');
            }
        }
    }

	/**
     * Delete device color 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteColor(Request $request)
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
            if(DeviceColor::where('id',$perameters['id'])->delete()){
                $message = array('success'=>true,'message'=>'Color delete successfully.');
                return json_encode($message);
            }else{
                $message = array('success'=>false,'message'=>'Color not delete.');
                return json_encode($message);
            }
        }
    }
    // End Device Color Section 
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Devices;

class DevicesController extends Controller
{
    public function devicesList(Request $request)
    {
        $devices = Devices::paginate(10);
    	return view('Admin.Devices.device-list',['devices'=>$devices]);
    }
    public function addDevicesForm(Request $request)
    {
    	return view('Admin.Devices.add-device');
    }
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
    public function editDevicesForm(Request $request,$deviceId)
    {
        $deviceId = base64_decode($deviceId);
        $device = Devices::find($deviceId);
        return view('Admin.Devices.edit-device',['device' => $device]);
    }
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
}

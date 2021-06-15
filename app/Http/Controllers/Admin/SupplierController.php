<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Supplier;
use App\CountriesModel;
use App\Helpers\CreateLogs;

class SupplierController extends Controller
{
    /**
     * Display Add supplier form
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function addSupplierForm(Request $request)
    {
        $countries = CountriesModel::get();
    	return view('Admin.Supplier.add_supplier',['countries'=>$countries]);
    }
    /**
     * Submit Add supplier form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addSupplier(Request $request)
    {
        $perameters = $request->all();
    	$validation = Validator::make($perameters,[
			'supplier_name' => 'required|unique:suppliers',
			'country' => 'required'
		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
			$perameters['status'] = 1;
			$supplier = Supplier::create($perameters);
			if($supplier){
				return redirect('/admin/suppliers')->with('success','Suppliers added successfully.');
			}else{
				return redirect()->back()->withInput()->with('error',"Somthing went wrong.");
			}
    	}
    }
    /**
     * Display edit supplier form 
     * @param  \Illuminate\Http\Request  $request
     * @param  $supplierID
     * @return \Illuminate\View\View
     */
    public function editSupplierForm(Request $request, $supplierID)
    {
    	$supplierID = base64_decode($supplierID);
        $supplier = Supplier::find($supplierID);
        $countries = CountriesModel::get();
    	return view('Admin.Supplier.edit_supplier',['supplier'=>$supplier,'countries'=>$countries]);
    }
    /**
     * Submit edit supplier form 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function editSupplier(Request $request)
    {
    	$perameters = $request->all();
    	$perameters['id'] = base64_decode($perameters['id']);
    	$validation = Validator::make($perameters,[
    		'id' 			=> 'required',
			'supplier_name' => 'required|unique:suppliers,supplier_name,'.$perameters['id'],
            'country'       => 'required'
		]);
		if ($validation->fails()) {
			return redirect()->back()->withInput()->with('error',$validation->messages()->first());
		}else{
			$supplier = Supplier::find($perameters['id']);
			$supplier->supplier_name = $perameters['supplier_name'];
			$supplier->country = $perameters['country'];
			if($supplier->save()){
				return redirect('/admin/suppliers')->with('success','Suppliers updated successfully.');
			}else{
				return redirect()->back()->withInput()->with('error',"Somthing went wrong.");
			}
    	}
    }
    /**
     * Get all suppliers from database 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function supplierList(Request $request)
    {
    	$suppliers = Supplier::orderBy('id','DESC')->paginate(10);
    	return view('Admin.Supplier.suppliers-list',['suppliers'=>$suppliers]);
    }
    /**
     * Delete supplier 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function deleteSupplier(Request $request)
    {
    	$perameter = $request->all();
    	$validation = Validator::make($perameter,[
    	    'id' => 'required'
    	]);
    	if ($validation->fails()) {
    	    return redirect()->back()->withInput()->with('error',$validation->messages()->first());
    	}else{
    		$perameter['id'] = base64_decode($perameter['id']);
    	    $deleteSupplier = Supplier::where('id',$perameter['id'])->delete();
    	    if($deleteSupplier){
    	        $message = array('success'=>true,'message'=>'Delete successfully.');
    	        return json_encode($message);
    	    }else{
    	        $message = array('success'=>false,'message'=>'Somthing went wrong!');
    	        return json_encode($message);
    	    }
    	}
    }
    /**
     * Approved and un approved supplier 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function approveSupplier(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'id' => 'required',
            'status' => 'required'
        ]);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $user = \Auth::guard('admin')->user();
            $supplier = Supplier::find($perameter['id']);
            if($supplier){
                if($perameter['status'] == 1){
                    $supplier->status = 1;
                    if($supplier->save()){
                        $logData = [
                            'user_id'           => $user->id,
                            'log_type'          => 7,
                            'type'              => 1,
                            'user_status'       => $user->is_active,
                            'user_name'         => $user->firstname.' '.$user->lastname,
                            'email'             => $user->email,
                            'request_type'      => 3,
                            'reuqest_param_name'=> $supplier->supplier_name,
                            'appr_disapp_status'=> 1 
                        ];
                        CreateLogs::createLog($logData);
                        $message = array('success'=>true,'message'=>'Approved successfully.');
                        return json_encode($message);
                    }else{
                        $message = array('success'=>false,'message'=>'Somthing went wrong!');
                        return json_encode($message);
                    }
                }else{
                    $supplier->status = 0;
                    if($supplier->save()){
                        $logData = [
                            'user_id'           => $user->id,
                            'log_type'          => 7,
                            'type'              => 1,
                            'user_status'       => $user->is_active,
                            'user_name'         => $user->firstname.' '.$user->lastname,
                            'email'             => $user->email,
                            'request_type'      => 3,
                            'reuqest_param_name'=> $supplier->supplier_name,
                            'appr_disapp_status'=> 0 
                        ];
                        CreateLogs::createLog($logData);
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
    /**
     * Set default supplier 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function setDefaultSupplies(Request $request)
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
            $defaultBrand = Supplier::where('default',1)->first();
            if($defaultBrand){
                $defaultBrand->default = 0;
                if($defaultBrand->save()){
                    if($brand = Supplier::find($perameters['id'])){
                        $brand->default = $perameters['status'];
                        if($brand->save()){
                            $message = array('success'=>true,'message'=>'Supplier set default successfully.','status'=>$perameters['status']);
                        }else{
                            $message = array('success'=>false,'message'=>'Supplier not set default.');
                        }
                    }else{
                        $message = array('success'=>false,'message'=>'Supplier not set default.');
                    }
                }else{
                    $message = array('success'=>false,'message'=>'Somthing went wrong.');
                }
            }else{
                if($brand = Supplier::find($perameters['id'])){
                    $brand->default = $perameters['status'];
                    if($brand->save()){
                        $message = array('success'=>true,'message'=>'Supplier set default successfully.','status'=>$perameters['status']);
                    }else{
                        $message = array('success'=>false,'message'=>'Supplier not set default.');
                    }
                }else{
                    $message = array('success'=>false,'message'=>'Supplier not set default.');
                }
            }
            return json_encode($message);
            
        }
    }
}

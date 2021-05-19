<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Brands;
use Excel;

class IndependentController extends Controller
{
    public function inportBrandFromCSV(Request $request)
    {
        $rules = array(
            'file' => 'required'
        );
    
        $validator = Validator::make(Input::all(), $rules);
        // process the form
        if ($validator->fails()) 
        {
            return json_encode(['success'=> false, 'message'=> 'File is required.']);
        }
        else 
        {
            
            try {
                $path = Input::file('file');
                $data = Excel::load($path)->get();
                $ModelsData = [];
                foreach ($data->toArray() as $row) {
                    $now = date("Y-m-d H:i:s");
                    if($row['device_type'] == 'Mobile Phone'){
                        $type = 8;
                    }else{
                        $type = 12;
                    }
                    $model = [
                        'brand_name'    => $row['developer'],
                        'model_name'    => $row['model'],
                        'device_type'   => $type,
                        'colors_id'     => null,
                        'user_id'       => 0,
                        'default'       => 0,
                        'status'        => 1,
                        'created_at'    => $now,
                        'updated_at'    => $now
                    ];
                    array_push($ModelsData, $model);
                }
                Brands::insert($ModelsData);
                return json_encode(['success'=> true, 'message'=> 'Data import', 'data'=> $data]);
                
            } catch (\Exception $e) {
                return json_encode(['success'=> false, 'message'=> 'Somthing went wrong', 'error'=> $e]);
            }
        } 
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\FrontEnd\PlanDeviceRating;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\DeviceReview;
use App\Models\FrontEnd\ServiceRating;
use App\Models\Admin\RatingQuestion;
use App\Helpers\GenerateNickName;
use App\Models\Admin\ServiceType;
use App\Models\Admin\Provider;
use Illuminate\Http\Request;
use App\CountriesModel;
use App\UserAddress;
use App\Currency;
use App\User;
use DB, Excel, Auth,Mail;
use App\Models\Admin\SettingsModel;

class IndependentController extends Controller
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
    public function localSet(Request $request)
    {
            return redirect($url);
    }
    public function sendEmail()
    {
            mail("jatinder.kumar@softradix.com","My subject","First line of text");
    }

    /**
     * Migration of nickname if user not have nickname 
     */
    public function addNikNameIfNotExist()
    {
      $users = User::get();
      
      foreach($users as $user){
        if($user->nickname == ""){
          $nickname = GenerateNickName::nickName($user->firstname);
          $user->nickname = $nickname;
          $user->save();
        } 
      }
      return json_encode(array('success'=>true));
    }


    /**
     * 
     */
    public function importPlanRecordExcelFile(Request $request)
    {
      $input = $request->all();
    	$validation = Validator::make($input,[
        'excelFile' => 'required|mimes:xls,xlsx',
        'user_id' => 'required'
    	]);
    	if ($validation->fails()) {
            $message = array('success'=>false,'message'=>$validation->messages()->first());
            return json_encode($message);
    	}else{
            $path = $request->file('excelFile')->getRealPath();
            $data = Excel::load($path)->get()[0];
            $user_id = $input['user_id'];
            // $allData = [];
            if($data->count() > 0 ){
            foreach($data->toArray() as $key => $value)
                {
                DB::beginTransaction();
                try {
                    $client = new \GuzzleHttp\Client();
                    $response = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s&address='.$value['city'].' '.$value['postal_code'].' '.strtolower($value['country']));
                    $response = json_decode($response->getBody());
                    if($response->results){
                        $addresses['formatted_address'] = $response->results[0]->formatted_address;
                        $addresses['location'] = $response->results[0]->geometry->location;
                        $insertAddress = [
                            'user_id' => $user_id,
                            'country' => ucfirst(strtolower($value['country'])),
                            'city' => $value['city'],
                            'longitude' => $addresses['location']->lng,
                            'latitude' => $addresses['location']->lat,
                            'postal_code' => $value['postal_code'],
                            'formatted_address' => $addresses['formatted_address'],
                            'is_primary' => 0,
                        ];
                        $reviewAddress = UserAddress::create($insertAddress);
                        $address_id = $reviewAddress->id;
                    }else{
                        $userAddress = UserAddress::where('user_id',$user_id)->where('is_primary',1)->first();
                        if($userAddress){
                            $addresses['formatted_address'] = $userAddress->formatted_address;
                            $addresses['location']->lng = $userAddress->longitude;
                            $addresses['location']->lat = $userAddress->latitude;
                            $address_id = $userAddress->id;
                        }else{
                            $address_id = NULL;
                        }
                    }
                    // Add Provider If Not Exist
                    $provider = Provider::where('provider_name',$value['provider'])->first();
                    if($provider){
                    $provider_id = $provider->id;
                    }else{
                    $dataInsertProvider = [
                        'provider_name' => $value['provider'],
                        'country' => ucfirst(strtolower($value['country'])),
                        'user_id' => 0,
                        'status' => 1
                    ];
                    $newProvider = Provider::create($dataInsertProvider);
                    $provider_id = $newProvider->id;
                    }
                    $value['contrcat_type'] = preg_replace('/\s/', '',$value['contrcat_type']);
                    $contract_type = $value['contrcat_type'] == "personal" ? 1 : 2;
                    // Add Service Type if not exist
                    $service_type = ServiceType::where('service_type_name',$value['service_type'])->first();
                    if($service_type){
                    $service_type_id = $service_type->id;
                    }else{
                    $dataInsertServiceType = [
                        'service_type_name' => $value['service_type'],
                        'status' => 1,
                        'type' => $contract_type
                    ];
                    $newServiceType = ServiceType::create($dataInsertServiceType);
                    $service_type_id = $newServiceType->id;
                    }
                    $value['country'] = ucfirst(strtolower($value['country']));

                    $currency = Currency::where('name',$value['country'])->first();
                    if($currency){
                    $currency_id = $currency->id;
                    }else{
                    $currency_id = NULL;
                    }
                    $countries = CountriesModel::where('name',$value['country'])->first();
                    if($countries){
                    $countries_code = $countries->code;
                    }else{
                    $countries_code = NULL;
                    }
                    // $ip = env('ip_address','live');
                    // if($ip == 'live'){
                    //     $ip = $_SERVER['REMOTE_ADDR'];
                    // }else{
                    //     $ip = '96.46.34.142';
                    // }
                    // $client = new \GuzzleHttp\Client();
                    // $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey='.env("ipgeoapikey").'&ip='.$ip);
                    // $newresponse = json_decode($newresponse->getBody());
                    
                    // $current_lat = $newresponse->latitude;
                    // $current_long = $newresponse->longitude;

                    $planReviewDataInsert = [
                    'user_id'             => $user_id,
                    'provider_id'         => $provider_id ,
                    'contract_type'       => $contract_type,
                    'price'               => $value['price'],
                    'currency_id'         => $currency_id,
                    'payment_type'        => strtolower($value['paymnet_type']),
                    'service_type'        => $service_type_id,
                    'technology'          => $value['technology'],
                    'local_min'           => 100,
                    'datavolume'          => $value['data_volume'],
                    'long_distance_min'   => 'Unlimited',
                    'international_min'   => 0,
                    'roaming_min'         => 0,
                    'downloading_speed'   => 0,
                    'uploading_speed'     => 0,
                    'speedtest_type'      => 0,
                    'sms'                 => 'Unlimited',
                    'average_review'      => $value['average_rate'],
                    'country_code'        => $countries_code,
                    'longitude'           => $addresses['location']->lng,
                    'latitude'            => $addresses['location']->lat 
                    ];
                    $allData[] =  $value;
                    $addedPlan = ServiceReview::create($planReviewDataInsert);
                    
                    $rating_id = PlanDeviceRating::where('user_id',$user_id)->where('plan_id',$addedPlan->id)->max('rating_id');
                    $rating_id = $rating_id+1;
                    $input['user_address_id'] = $address_id;

                    $perameters=[
                        'user_id' => $user_id,
                        'plan_id' => $addedPlan->id,
                        'rating_id'=> $rating_id,
                        'comment'=> NULL,
                        'average' => 5,
                        'user_address_id' => $input['user_address_id']
                    ];
                    $validation = Validator::make($perameters, [
                        'user_id' => 'required',
                        'plan_id' => 'required',
                        'average' => 'required',
                        'user_address_id' => 'required'
                    ]);
                    if ( $validation->fails() ) {
                        $message = array('success'=>false,'message'=>$validation->messages()->first());
                        return json_encode($message);
                    }else{
                        $date = date("Y-m-d H:i:s");
                        $data = [];
                        $plandevicerating = PlanDeviceRating::create($perameters);
                        if($plandevicerating){
                        $questions = RatingQuestion::Where('type',1)->get();
                            foreach ($questions as $question) {
                                $dataInsert = [
                                    'user_id'=>$user_id,
                                    'entity_id'=>$plandevicerating->plan_id,
                                    'entity_type'=>1,
                                    'rating_id'=>$plandevicerating->rating_id,
                                    'question_id'=>$question->id,
                                    'rating'=>5,
                                    'text_field_value'=>NULL,
                                    'created_at'=>$date,
                                    'updated_at'=>$date
                                ];
                                array_push($data, $dataInsert);
                            }
                            $serviceRating = ServiceRating::insert($data);
                            $average = 5;
                            ServiceReview::where('id',$plandevicerating->plan_id)->update(['average_review' => $average]);  
                        }
                    }
                    DB::commit();
                    print_r($value);
                    echo "  Done <br>";
                }catch (\Exception $e) {
                    echo "  Not Done <br>";
                    print_r($value);
                    echo "Data Not Added";
                    print_r($e);
                    echo "<br>";
                    DB::rollback();
                    // something went wrong
                }
            }
            }
        return $allData;
      }
    }

    /**
     * Independent script for address migration 
     */
    public function addressMigration(Request $request)
    {
        $getPlanDeviceRating = PlanDeviceRating::get();
        foreach($getPlanDeviceRating as $row){
            DB::beginTransaction();
			try {
                $address = UserAddress::find($row->user_address_id);
                $row->address = $address->address;
                $row->country = $address->country;
                $row->city = $address->city;
                $row->longitude = $address->longitude;
                $row->latitude = $address->latitude;
                $row->postal_code = $address->postal_code;
                $row->formatted_address = $address->formatted_address;
                $row->save();
                DB::commit();
                echo json_encode(array('success'=>true,'message'=>'Migration complete successfully.','id'=>$row->id));
			    // all good
			} catch (\Exception $e) {
				echo json_encode(array('success'=>false,'message'=>'Migration not complete successfully.','id'=>$row->id));
			    DB::rollback();
			    // something went wrong
			}
        }
        
        // echo "<pre>";
        // print_r($getPlanDeviceRating->toArray());
        exit;
    }

    /**
     * Set cookie of footer popup
     */
    public function cookieSet(Request $request)
    {
        setcookie('popup', 'agree', time() + (10 * 365 * 24 * 60 * 60), '/');
        return json_encode(array('success'=> true));
    }

    /**
     * Independent script for fixing old plan review bugs 
     */
    public function fixedOldPlanDataIssue(Request $request)
    {
        $plans = ServiceReview::select('id','country_code','created_at','latitude','longitude')->whereYear('created_at','=','2019')->paginate(50);
        
        foreach($plans as $plan){
            DB::beginTransaction();
			try {
                $country_code = $plan->country_code;
                $new_code = '';
                $lat = $plan->latitude;
                $long = $plan->longitude;
                $client = new \GuzzleHttp\Client();
                $newresponse = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&&key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s');
                $newresponse = json_decode($newresponse->getBody());
                $newresponse  = $newresponse->results;
                $newresponse = $newresponse[0];
                $newresponse = $newresponse->address_components;
                foreach ($newresponse as $key) {
                    if($key->types[0] == 'country')
                    {
                        $new_code = $key->short_name;
                        ServiceReview::where('id',$plan->id)->update(['country_code'=> $new_code]);
                    }
                }
                DB::commit();
                echo 'PlanId => '.$plan->id.' OldCode => '.$country_code.' New Code => '.$new_code.'<br>' ;
			    // all good
			} catch (\Exception $e) {
                echo 'planId => '.$plan->id ;
				
			    DB::rollback();
			    // something went wrong
			}
        }
    }
    /**
     * Independent script for fixing old device review bugs 
     */
    public function fixedOldDeviceDataIssue(Request $request)
    {
        $device = DeviceReview::select('id','country_code','created_at','latitude','longitude')->whereYear('created_at','=','2019')->paginate(50);
        
        foreach($device as $device){
            DB::beginTransaction();
			try {
                $country_code = $device->country_code;
                $new_code = '';
                $lat = $device->latitude;
                $long = $device->longitude;
                $client = new \GuzzleHttp\Client();
                $newresponse = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?latlng='.$lat.','.$long.'&&key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s');
                $newresponse = json_decode($newresponse->getBody());
                $newresponse  = $newresponse->results;
                $newresponse = $newresponse[0];
                $newresponse = $newresponse->address_components;
                foreach ($newresponse as $key) {
                    if($key->types[0] == 'country')
                    {
                        $new_code = $key->short_name;
                        DeviceReview::where('id',$device->id)->update(['country_code'=> $new_code]);
                    }
                }
                DB::commit();
                echo 'deviceId => '.$device->id.' OldCode => '.$country_code.' New Code => '.$new_code.'<br>' ;
			    // all good
			} catch (\Exception $e) {
                echo 'deviceId => '.$device->id ;
				
			    DB::rollback();
			    // something went wrong
			}
        }
    }

    /**
     * Update old records of user address table
     */
    public function updateUserAddressTable(Request $request)
    {
        $userAddress = UserAddress::get();
        foreach($userAddress as $user){
            $code = CountriesModel::where('name',$user->country)->select('code')->first();
            if($code){
                $user->country_code = $code->code;
                $user->save();
            }else{
                $user->country_code = 'CA';
                $user->save();
            }
            
        }
    }

    public function updateLatLngBasisOnAddress(Request $request)
    {
        $PlanDeviceRating = PlanDeviceRating::where('postal_code','!=','')->where('country','!=','')->whereYear('created_at',"<", date('Y'))->orderBy('created_at','DESC')->paginate($request->limit);
        foreach($PlanDeviceRating as $review){
            DB::beginTransaction();
			try {
                if($review->postal_code != ""){
                    $postal = $review->postal_code;
                    $city = $review->city;
                    $country = $review->country;
                    if($city == ""){
                        $address = $country.', '.$postal;
                    }else{
                        $address = $country.', '.$city .', '.$postal;
                    }
                    $client = new \GuzzleHttp\Client();
                    $newresponse = $client->request('GET', 'https://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&key=AIzaSyBF1pe8Sl7TDb-I7NBP-nviaZmDpnmNk_s');
                    $newresponse = json_decode($newresponse->getBody());
                    $newresponse  = $newresponse->results;
                    if(count($newresponse)>0){
                        $newresponse = $newresponse[0];
                        $geometry = $newresponse->geometry;
                        $location = $geometry->location;
                        $reviewDetail = PlanDeviceRating::find($review->id);
                        $reviewDetail->longitude = $location->lng;
                        $reviewDetail->latitude = $location->lat;
                        $reviewDetail->save();
                        DB::commit();
                        echo 'Success :- reviewId => '.$review->id.'<br>' ;
                    }else{
                        echo 'Not Complete :- reviewId => '.$review->id.'<br>' ;
                    }
                }
                
			    // all good
			} catch (\Exception $e) {
                echo 'Error :- reviewId => '.$review->id.'<br>';
				
			    DB::rollback();
			    // something went wrong
			}
        }
    }

    /**
     * Unsubscribed form
     */
    public function unsubscribed(Request $request, $token)
    {
        $token = base64_decode($token);
        return view('FrontEnd/Unsubscribed/unsubscribed',['email'=> $token]);
    }
    
    /**
     * Unsubscribed user from event email
     */
    public function unsubscribedUser(Request $request)
    {
        $perameter = $request->all();
        $validation = Validator::make($perameter,[
            'user_token' => 'required'
        ]);
        if($validation->fails()){
            return redirect()->back()->withInput()->with('error',$validation->messages()->first());
        }else{
            $token = base64_decode($perameter['user_token']);
            $reason = $perameter['unsubscribe_reason'] ? $perameter['unsubscribe_reason'] : '';
            $user = User::where('email',$token)->update(['is_subscribed' => 0,'unsubscribe_reason'=>$reason]);
            if($user){
                return redirect("/thankyou/".base64_encode($token))->withInput();
            }else{
                return redirect()->back()->withInput()->with('error',"Somting went wrong, please try again later");
            }
        }
    }
    
    public function thankyou(Request $request, $token)
    {
        return view('FrontEnd/Unsubscribed/thankyou',['email'=> base64_decode($token)]);
    }

    public function termsAndConditions()
    {
        $settings = SettingsModel::first();
        return view('FrontEnd/Terms/TermsAndCondition',['settings'=>$settings]);
    }
    public function privacyPolicy()
    {
        $settings = SettingsModel::first();
        return view('FrontEnd/Terms/Privacy',['settings'=>$settings]);
    }
    public function cookiePolicy()
    {
        $settings = SettingsModel::first();
        return view('FrontEnd/Terms/Cookie',['settings'=>$settings]);
    }
    /**
     * For email testing
     */
    public function testEmail(Request $request){
        $email = $request->email;
        $text = "Hi ". $email;
        Mail::raw($text, function($m) use($email){
          $m->from(env('MAIL_FROM_ADDRESS','support@telecey.com'), env('MAIL_FROM_NAME','TELECEY'));
          $m->to($email);
          $m->subject('Testing Email');
        });
    }
}

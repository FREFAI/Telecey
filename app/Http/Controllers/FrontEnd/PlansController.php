<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\AdsModel;
use App\Models\Admin\ServiceType;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\PlanDeviceRating;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\RatingQuestion;
use App\UserAddress;
use App\CountriesModel;
use App\Helpers\CreateLogs;
use DB;
class PlansController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $settings = SettingsModel::first();
        view()->composer('layouts/frontend_layouts/header', function ($view) use ($settings) {
            $view->with('settings', $settings);
        });
    }

    /**
     * Get latest 3 plan reviews
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function plans(Request $request) {
        // Current location section
        $ip = env('ip_address', 'live');
        if ($ip == 'live') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '14.99.89.178';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . env("ipgeoapikey") . '&ip=' . $ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_location = $newresponse->country_name . ',' . $newresponse->state_prov . ',' . $newresponse->city . ',' . $newresponse->zipcode;
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;
        $current_country_code = $newresponse->country_code2;
        $filtersetting = SettingsModel::first();
        $limit = 3;
        $user = Auth::guard('customer')->user();
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        $country = CountriesModel::select('id')->where('name', $newresponse->country_name)->first();
        $data = $request->all();
        $searchResult = ServiceReview::select(DB::raw('*, ( 6371 * acos( cos( radians(' . $current_lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $current_long . ') ) + sin( radians(' . $current_lat . ') ) * sin( radians( latitude ) ) ) ) AS distance'))->where('country_code', $current_country_code)->with('provider', 'currency', 'typeOfService', 'user', 'ratings', 'plan_rating')->groupBy('provider_id')->orderBy('distance', 'ASC')->paginate($limit);
        if(!$searchResult){
            $searchResult = ServiceReview::inRandomOrder()->select(DB::raw('*, ( 6371 * acos( cos( radians(' . $current_lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $current_long . ') ) + sin( radians(' . $current_lat . ') ) * sin( radians( latitude ) ) ) ) AS distance'))->with('provider', 'currency', 'typeOfService', 'user', 'ratings', 'plan_rating')->orderBy('distance', 'ASC')->paginate($limit);
        }
        return view('FrontEnd.plans', ['ip_location' => $current_location, 'filtersetting' => $filtersetting, 'data' => $searchResult, 'service_types' => $service_types,'current_country_code'=> $current_country_code,'current_lat'=> $current_lat,'current_long'=> $current_long ]);
    }

    /**
     * Get filted plan reviews from db with distance logic
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function plansResult(Request $request) {
        $data = $request->all();
        // Current location section
        $ip = env('ip_address', 'live');
        if ($ip == 'live') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '14.99.89.178';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . env("ipgeoapikey") . '&ip=' . $ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_location = $newresponse->country_name . ',' . $newresponse->state_prov . ',' . $newresponse->city . ',' . $newresponse->zipcode;
        $current_lat = array_key_exists("lat", $data) && $data['lat'] != "" ? $data['lat'] : $newresponse->latitude;
        $current_long = array_key_exists("lng", $data) && $data['lng'] != "" ? $data['lng'] : $newresponse->longitude;
        $current_country_code = array_key_exists("country", $data) && $data['country'] != "" ? $data['country'] : $newresponse->country_code2;
        $filtersetting = SettingsModel::first();
        if (!Auth::guard('customer')->check()) {
            $limit = $filtersetting->no_of_search_record ? $filtersetting->no_of_search_record : 20;
        } else {
            if (array_key_exists("rows", $data)) {
                $limit = $data['rows'];
            } else {
                $limit = 20;
            }
        }
        $country = CountriesModel::select('id')->where('name', $newresponse->country_name)->first();
        $ads = AdsModel::with('countries')->where('is_active', 1)->where(function ($query) use ($country) {
            $query->where('is_global', 1)->orWhere('country', $country->id);
        })->get()->toArray();
        $googleads = AdsModel::where('type', 1)->first();
        $user = Auth::guard('customer')->user();
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        if (count($data) > 1) {
            $filter = 1;
            if (array_key_exists("filter", $data)) {
                $filter = $data['filter'];
            }
            $mainQuery = PlanDeviceRating::query();
            $mainQuery->leftJoin('service_reviews', 'plan_device_rating.plan_id', '=', 'service_reviews.id');
            $mainQuery->leftJoin('providers', 'providers.id', '=', 'service_reviews.provider_id');
            $mainQuery->leftJoin('users', 'users.id', '=', 'plan_device_rating.user_id');
            $mainQuery->select(DB::raw('( 6371 * acos( cos( radians(' . $current_lat . ') ) * cos( radians( plan_device_rating.latitude ) ) * cos( radians( plan_device_rating.longitude ) - radians(' . $current_long . ') ) + sin( radians(' . $current_lat . ') ) * sin( radians( plan_device_rating.latitude ) ) ) ) AS distance'), 'plan_device_rating.plan_id as id', 'plan_device_rating.longitude', 'plan_device_rating.latitude', 'service_reviews.price', 'service_reviews.local_min', 'providers.provider_image_original', 'providers.provider_name', 'providers.provider_image_resize', 'providers.status', 'service_reviews.provider_id', 'plan_device_rating.average', 'users.is_active', 'service_reviews.datavolume', 'service_reviews.average_review');
            $mainQuery->where('plan_device_rating.plan_id', '!=', 0);
            $mainQuery->where('providers.provider_name', '!=','');
            $mainQuery->where('providers.status',1);
            $mainQuery->whereNotNull('plan_device_rating.longitude')->whereNotNull('plan_device_rating.latitude');
            $mainQuery->where('service_reviews.country_code', $current_country_code);
            if ($filtersetting && $filtersetting->reviews_for_unverified == 0) {
                $mainQuery->where('users.is_active', 1);
            }
            $mainQuery->where(function ($query) use ($data) {
                if (array_key_exists("service_type", $data) && $data['service_type'] != "") {
                    $query->orWhere('service_reviews.service_type', $data['service_type']);
                }
                if (!array_key_exists("min_type", $data)) {
                    if (array_key_exists("local_min", $data)) {
                        $query->orWhere('service_reviews.local_min', $data['local_min']);
                    }
                }
                if (array_key_exists("datavolume", $data) && $data['datavolume'] != "") {
                    $query->orWhere('service_reviews.datavolume', $data['datavolume']);
                }
                if (array_key_exists("contract_type", $data) && $data['contract_type'] != "") {
                    $query->orWhere('service_reviews.contract_type', $data['contract_type']);
                } else {
                    $query->orWhere('service_reviews.contract_type', 1);
                }
                if (array_key_exists("payment_type", $data) && $data['payment_type'] != "") {
                    $query->orWhere('service_reviews.payment_type', $data['payment_type']);
                } else {
                    $query->orWhere('service_reviews.payment_type', 'postpaid');
                }
                if (array_key_exists("pay_as_usage_type", $data)) {
                    $query->orWhere('service_reviews.pay_as_usage_type', $data['pay_as_usage_type']);
                }
            });
            $searchResultCount = $mainQuery->count();
            $searchResult = $mainQuery->groupBy('plan_device_rating.plan_id')->orderBy('distance', 'ASC')->paginate($limit);
            foreach ($searchResult as $key => $value) {
                $user_address = '';
                $sum = 0;
                $average = 0;
                $user_address = UserAddress::where('user_id', $searchResult[$key]['user_id'])->where('is_primary', 1)->value('formatted_address');
                $searchResult[$key]['user_address'] = $user_address;
            }
            if ($user_id) {
                $logData = ['user_id' => $user->id, 'log_type' => 5, 'type' => 2, 'filter_type' => 1, 'user_status' => $user->is_active, 'user_name' => $user->firstname . ' ' . $user->lastname, 'user_number' => $user->mobile_number, 'email' => $user->email, 'filter_params' => json_encode($data), 'filter_search_result_count' => $searchResultCount];
            } else {
                $logData = ['log_type' => 5, 'type' => 2, 'filter_type' => 1, 'ip' => $ip, 'filter_params' => json_encode($data), 'filter_search_result_count' => $searchResultCount];
            }
            CreateLogs::createLog($logData);
        } else {
            $searchResult = [];
            $filter = 1;
        }
        return view('FrontEnd.plansResult', ['ip_location' => $current_location, 'filtersetting' => $filtersetting, 'ads' => $ads, 'googleads' => $googleads, 'service_types' => $service_types, 'data' => $searchResult, 'filterType' => $filter]);
    }

    /**
     * Plan review list sorting function which triggers through ajax call
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function plansResultSorting(Request $request) {
        $params = $request->all();
        $requestData = explode('&', $params['requestParams']);
        $data = [];
        foreach ($requestData as $rd) {
            $param = explode('=', $rd);
            $data[str_replace('?', '', $param[0]) ] = $param[1];
        }
        $ip = env('ip_address', 'live');
        if ($ip == 'live') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '14.99.89.178';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . env("ipgeoapikey") . '&ip=' . $ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_location = $newresponse->country_name . ',' . $newresponse->state_prov . ',' . $newresponse->city . ',' . $newresponse->zipcode;
        $current_lat = array_key_exists("lat", $data) && $data['lat'] != "" ? $data['lat'] : $newresponse->latitude;
        $current_long = array_key_exists("lng", $data) && $data['lng'] != "" ? $data['lng'] : $newresponse->longitude;
        $current_country_code = array_key_exists("country", $data) && $data['country'] != "" ? $data['country'] : $newresponse->country_code2;
        $filtersetting = SettingsModel::first();
        if (!Auth::guard('customer')->check()) {
            $limit = $filtersetting->no_of_search_record ? $filtersetting->no_of_search_record : 20;
        } else {
            $limit = 20;
        }
        $user = Auth::guard('customer')->user();
        $user_id = Auth::guard('customer')->id();
        $service_types = ServiceType::get();
        $filter = 1;
        if (array_key_exists("filter", $data)) {
            $filter = $data['filter'];
        }
        $country = CountriesModel::select('id')->where('name', $newresponse->country_name)->first();
        $ads = AdsModel::with('countries')->where('is_active', 1)->where(function ($query) use ($country) {
            $query->where('is_global', 1)->orWhere('country', $country->id);
        })->get()->toArray();
        $googleads = AdsModel::where('type', 1)->first();
        $mainQuery = PlanDeviceRating::query();
        $mainQuery->leftJoin('service_reviews', 'plan_device_rating.plan_id', '=', 'service_reviews.id');
        $mainQuery->leftJoin('providers', 'providers.id', '=', 'service_reviews.provider_id');
        $mainQuery->leftJoin('users', 'users.id', '=', 'plan_device_rating.user_id');
        $mainQuery->select(DB::raw('( 6371 * acos( cos( radians(' . $current_lat . ') ) * cos( radians( plan_device_rating.latitude ) ) * cos( radians( plan_device_rating.longitude ) - radians(' . $current_long . ') ) + sin( radians(' . $current_lat . ') ) * sin( radians( plan_device_rating.latitude ) ) ) ) AS distance'), 'plan_device_rating.plan_id as id', 'plan_device_rating.longitude', 'plan_device_rating.latitude', 'service_reviews.price', 'service_reviews.local_min', 'providers.provider_image_original', 'providers.provider_name', 'providers.provider_image_resize', 'providers.status', 'service_reviews.provider_id', 'plan_device_rating.average', 'users.is_active', 'service_reviews.datavolume', 'service_reviews.average_review');
        $mainQuery->where('providers.provider_name', '!=','');
        $mainQuery->where('providers.status',1);
        $mainQuery->where('plan_device_rating.plan_id', '!=', 0);
        $mainQuery->whereNotNull('plan_device_rating.longitude')->whereNotNull('plan_device_rating.latitude');
        $mainQuery->where('service_reviews.country_code', $current_country_code);
        $mainQuery->where(function ($query) use ($data) {
            if (array_key_exists("service_type", $data) && $data['service_type'] != "") {
                $query->orWhere('service_reviews.service_type', $data['service_type']);
            }
            if (!array_key_exists("min_type", $data)) {
                if (array_key_exists("local_min", $data)) {
                    $query->orWhere('service_reviews.local_min', $data['local_min']);
                }
            }
            if (array_key_exists("datavolume", $data) && $data['datavolume'] != "") {
                $query->orWhere('service_reviews.datavolume', $data['datavolume']);
            }
            if (array_key_exists("contract_type", $data) && $data['contract_type'] != "") {
                $query->orWhere('service_reviews.contract_type', $data['contract_type']);
            } else {
                $query->orWhere('service_reviews.contract_type', 1);
            }
            if (array_key_exists("payment_type", $data) && $data['payment_type'] != "") {
                $query->orWhere('service_reviews.payment_type', $data['payment_type']);
            } else {
                $query->orWhere('service_reviews.payment_type', 'postpaid');
            }
            if (array_key_exists("pay_as_usage_type", $data)) {
                $query->orWhere('service_reviews.pay_as_usage_type', $data['pay_as_usage_type']);
            }
        });
        $searchResultCount = $mainQuery->count();
        if ($params['name'] != "distance") {
            $mainQuery->orderBy('service_reviews.' . $params['name'], $params['sort']);
        } else {
            $mainQuery->orderBy($params['name'], $params['sort']);
        }
        $searchResult = $mainQuery->groupBy('plan_device_rating.plan_id')->paginate($limit);
        foreach ($searchResult as $key => $value) {
            $user_address = '';
            $sum = 0;
            $average = 0;
            $user_address = UserAddress::where('user_id', $searchResult[$key]['user_id'])->where('is_primary', 1)->value('formatted_address');
            $searchResult[$key]['user_address'] = $user_address;
        }
        return view('FrontEnd.plans.planSorting', ['data' => $searchResult, 'filtersetting' => $filtersetting, 'ads' => $ads, 'googleads' => $googleads]);
    }

    /**
     * Get detail of plan review
     * @param $id - plan review id
     * @return \Illuminate\View\View
     */
    public function planDetails($id) {
        $planDetailData = ServiceReview::where('id', $id)->with('provider', 'currency', 'typeOfService')->first();
        if ($planDetailData) {
            $user_address = UserAddress::where('user_id', $planDetailData->user_id)->where('is_primary', 1)->value('formatted_address');
            $planDetailData->user_address = $user_address;
            $allratings = $planDetailData->get_ratings($id);
            $plan_device_rating = $planDetailData->plan_device_rating->toArray();
            $key = [];
            $blankArray = [];
            foreach ($allratings as $ratings) {
                if (RatingQuestion::withTrashed()->where('id', $ratings->question_id)->first()) {
                    if ($ratings->entity_id == $planDetailData->id && $ratings->entity_type == 1) { //Check entity id is equal to plan id
                        $ratings->question = $ratings->question()->withTrashed()->first()->toArray();
                        $ratings->question_name = $ratings->question['question'];
                        $ratings->question_type = $ratings->question['type'];
                        unset($ratings->question);
                        if (!in_array($ratings->rating_id, $key)) {
                            $key[] = $ratings->rating_id;
                            $blankArray[$ratings->rating_id]['plan_id'] = $ratings->entity_id;
                            $blankArray[$ratings->rating_id]['ratingList'][] = $ratings->toArray();
                        } else {
                            $blankArray[$ratings->rating_id]['plan_id'] = $ratings->entity_id;
                            $blankArray[$ratings->rating_id]['ratingList'][] = $ratings->toArray();
                        }
                    }
                }
            }
            // echo "<pre>"; print_r($plan_device_rating); exit;
            foreach ($plan_device_rating as $plan_device) {
                if ($plan_device['plan_id'] == $planDetailData->id) { //Check plan_id is equal to plan id
                    $address = UserAddress::find($plan_device['user_address_id']);
                    if($address){
                        if (isset($address['formatted_address']) != NULL && $address['formatted_address'] != '') {
                            $blankArray[$plan_device['rating_id']]['formatted_address'] = $address['city'] . ' ' . $address['country'] . ' ' . $address['postal_code'];
                            // $blankArray[$plan_device['rating_id']]['formatted_address']=$address['formatted_address'];
                            
                        } else {
                            $blankArray[$plan_device['rating_id']]['formatted_address'] = 'N/A';
                        }
                    }else{
                        $blankArray[$plan_device['rating_id']]['formatted_address'] = $plan_device['city']. ' '.$plan_device['country']. ' '.$plan_device['postal_code'];
                    }
                    
                    $blankArray[$plan_device['rating_id']]['date'] = $plan_device['created_at'];
                    $blankArray[$plan_device['rating_id']]['comment'] = $plan_device['comment'];
                    $blankArray[$plan_device['rating_id']]['average'] = $plan_device['average'];
                    $blankArray[$plan_device['rating_id']]['user_address_id'] = $plan_device['user_address_id'];
                }
            }
            $planDetailData->ratings = $blankArray;
            // echo "<pre>";print_r($planDetailData->toArray());die;
            return view('FrontEnd.planDetail', ['service' => $planDetailData]);
        } else {
            abort(404);
        }
    }
}

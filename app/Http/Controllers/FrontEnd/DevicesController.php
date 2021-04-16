<?php
namespace App\Http\Controllers\FrontEnd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\SettingsModel;
use App\Models\Admin\Supplier;
use App\Models\Admin\Brands;
use App\Models\Admin\DeviceColor;
use App\Models\FrontEnd\DeviceReview;
use App\Helpers\CreateLogs;
use DB, Auth;
use App\Models\FrontEnd\PlanDeviceRating;
use App\UserAddress;
use App\Models\Admin\AdsModel;
use App\CountriesModel;
use Illuminate\Pagination\LengthAwarePaginator;
class DevicesController extends Controller {
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
    public function devicesNew(Request $request) {
        $filtersetting = SettingsModel::first();
        if ($filtersetting->device == 0) {
            return redirect('/');
        }
        $ip = env('ip_address', 'live');
        if ($ip == 'live') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '96.46.34.142';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . env("ipgeoapikey") . '&ip=' . $ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_location = $newresponse->country_name . ',' . $newresponse->state_prov . ',' . $newresponse->city . ',' . $newresponse->zipcode;
        $current_lat = $newresponse->latitude;
        $current_long = $newresponse->longitude;
        $current_country_code = $newresponse->country_code2;
        $brands = Brands::all();
        $colors = DeviceColor::all();
        $suppliers = Supplier::where('status', 1)->get();
        $searchResult = DeviceReview::select(DB::raw('*, ( 6371 * acos( cos( radians(' . $current_lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $current_long . ') ) + sin( radians(' . $current_lat . ') ) * sin( radians( latitude ) ) ) ) AS distance'))
        ->where('country_code', $current_country_code)
        ->with('brand', 'supplier', 'device_color_info', 'user', 'device_rating')
        ->orderBy('distance', 'ASC')
        ->offset(0)
        ->limit(3)
        ->get()
        ->toArray();
        return view('FrontEnd.devicesNew', ['ip_location' => $current_location, 'brands' => $brands, 'suppliers' => $suppliers, 'data' => $searchResult, 'filtersetting' => $filtersetting, 'colors' => $colors,'current_country_code'=> $current_country_code,'current_lat'=> $current_lat,'current_long'=> $current_long]);
    }
    public function devicesResult(Request $request) {
        $data = $request->all();
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
        if ($filtersetting->device == 0) {
            return redirect('/');
        }
        $user = \Auth::guard('customer')->user();
        $ip = env('ip_address', 'live');
        if ($ip == 'live') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '96.46.34.142';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . env("ipgeoapikey") . '&ip=' . $ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_location = $newresponse->country_name . ',' . $newresponse->state_prov . ',' . $newresponse->city . ',' . $newresponse->zipcode;
        $current_lat = array_key_exists("lat", $data) && $data['lat'] != "" ? $data['lat'] : $newresponse->latitude;
        $current_long = array_key_exists("lng", $data) && $data['lng'] != "" ? $data['lng'] : $newresponse->longitude;
        $current_country_code = array_key_exists("country", $data) && $data['country'] != "" ? $data['country'] : $newresponse->country_code2;
        $user_id = \Auth::guard('customer')->id();
        $brands = Brands::all();
        $colors = DeviceColor::all();
        $suppliers = Supplier::where('status', 1)->get();
        $country = CountriesModel::select('id')->where('name', $newresponse->country_name)->first();
        $ads = AdsModel::with('countries')->where('is_active', 1)->where(function ($query) use ($country) {
            $query->where('is_global', 1)->orWhere('country', $country->id);
        })->get()->toArray();
        $googleads = AdsModel::where('type', 1)->first();
        $mainQuery = DeviceReview::query();
        if ($data) {
            $mainQuery = PlanDeviceRating::query();
            $mainQuery->leftJoin('device_reviews', 'plan_device_rating.device_id', '=', 'device_reviews.id');
            $mainQuery->leftJoin('brands', 'brands.id', '=', 'device_reviews.brand_id');
            $mainQuery->leftJoin('suppliers', 'suppliers.id', '=', 'device_reviews.supplier_id');
            $mainQuery->leftJoin('users', 'users.id', '=', 'plan_device_rating.user_id');
            $mainQuery->select(DB::raw('( 6371 * acos( cos( radians(' . $current_lat . ') ) * cos( radians( plan_device_rating.latitude ) ) * cos( radians( plan_device_rating.longitude ) - radians(' . $current_long . ') ) + sin( radians(' . $current_lat . ') ) * sin( radians( plan_device_rating.latitude ) ) ) ) AS distance'), 'plan_device_rating.device_id as id', 'plan_device_rating.longitude', 'plan_device_rating.latitude', 'device_reviews.price', 'plan_device_rating.average', 'users.is_active','device_reviews.average_review','brands.brand_name','brands.model_name','suppliers.supplier_name','device_reviews.storage');
            $mainQuery->where('plan_device_rating.device_id', '!=', 0);
            $mainQuery->whereNotNull('plan_device_rating.longitude')->whereNotNull('plan_device_rating.latitude');
            $mainQuery->where('device_reviews.country_code', $current_country_code)->orderBy('distance', 'ASC');
            if ($filtersetting && $filtersetting->reviews_for_unverified == 0) {
                $mainQuery->where('users.is_active', 1);
            }
            $mainQuery->where(function ($query) use ($data) {
                if (array_key_exists("brand_name", $data) && $data['brand_name'] != "") {
                    $query->orWhere('device_reviews.brand_id', $data['brand_name']);
                }
                if (array_key_exists("storage", $data) && $data['storage'] != "") {
                    $query->orWhere('device_reviews.storage', $data['storage']);
                }
                if (array_key_exists("device_color", $data) && $data['device_color'] != "") {
                    $query->orWhere('device_reviews.device_color', $data['device_color']);
                }
            });
            $searchResultCount = $mainQuery->count();
            $searchResult = $mainQuery->groupBy('plan_device_rating.device_id')->paginate($limit);
            if ($searchResult) {
                foreach ($searchResult as $key => $value) {
                    $user_address = UserAddress::where('user_id', $searchResult[$key]['user_id'])->where('is_primary', 1)->value('formatted_address');
                    $searchResult[$key]['user_address'] = $user_address;
                }
            }
            if ($user_id) {
                $logData = ['user_id' => $user->id, 'log_type' => 4, 'type' => 2, 'filter_type' => 2, 'user_status' => $user->is_active, 'user_name' => $user->firstname . ' ' . $user->lastname, 'user_number' => $user->mobile_number, 'email' => $user->email, 'filter_params' => json_encode($data), 'filter_search_result_count' => $searchResultCount];
            } else {
                $logData = ['log_type' => 4, 'type' => 2, 'filter_type' => 2, 'ip' => $ip, 'filter_params' => json_encode($data), 'filter_search_result_count' => $searchResultCount];
            }
            CreateLogs::createLog($logData);
            return view('FrontEnd.devicesResult', ['ip_location' => $current_location, 'brands' => $brands, 'suppliers' => $suppliers, 'data' => $searchResult, 'filtersetting' => $filtersetting, 'colors' => $colors, 'ads' => $ads, 'googleads' => $googleads]);
        } else {
            $searchResult = [];
            return view('FrontEnd.devicesResult', ['ip_location' => $current_location, 'brands' => $brands, 'suppliers' => $suppliers, 'data' => $searchResult, 'filtersetting' => $filtersetting, 'colors' => $colors, 'ads' => $ads, 'googleads' => $googleads]);
        }
    }
    public function devicesResultSorting(Request $request) {
        $params = $request->all();
        $requestData = explode('&', $params['requestParams']);
        $data = [];
        foreach ($requestData as $rd) {
            $param = explode('=', $rd);
            $data[str_replace('?', '', $param[0]) ] = $param[1];
        }
        if (array_key_exists('page', $data)) {
            $page = $data['page'];
        } else {
            $page = 1;
        }
        $filtersetting = SettingsModel::first();
        if ($filtersetting->device == 0) {
            return redirect('/');
        }
        $user = \Auth::guard('customer')->user();
        if (!Auth::guard('customer')->check()) {
            $limit = $filtersetting->no_of_search_record ? $filtersetting->no_of_search_record : 20;
        } else {
            if (array_key_exists("rows", $data)) {
                $limit = $data['rows'];
            } else {
                $limit = 20;
            }
        }
        $ip = env('ip_address', 'live');
        if ($ip == 'live') {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '96.46.34.142';
        }
        $client = new \GuzzleHttp\Client();
        $newresponse = $client->request('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . env("ipgeoapikey") . '&ip=' . $ip);
        $newresponse = json_decode($newresponse->getBody());
        $current_location = $newresponse->country_name . ',' . $newresponse->state_prov . ',' . $newresponse->city . ',' . $newresponse->zipcode;
        $current_lat = array_key_exists("lat", $data) && $data['lat'] != "" ? $data['lat'] : $newresponse->latitude;
        $current_long = array_key_exists("lng", $data) && $data['lng'] != "" ? $data['lng'] : $newresponse->longitude;
        $current_country_code  = array_key_exists("country", $data) && $data['country'] != "" ? $data['country'] :  $newresponse->country_code2;
        $country = CountriesModel::select('id')->where('name', $newresponse->country_name)->first();
        $ads = AdsModel::with('countries')->where('is_active', 1)->where(function ($query) use ($country) {
            $query->where('is_global', 1)->orWhere('country', $country->id);
        })->get()->toArray();
        $googleads = AdsModel::where('type', 1)->first();
        $mainQuery = PlanDeviceRating::query();
        $mainQuery->leftJoin('device_reviews', 'plan_device_rating.device_id', '=', 'device_reviews.id');
        $mainQuery->leftJoin('brands', 'brands.id', '=', 'device_reviews.brand_id');
        $mainQuery->leftJoin('suppliers', 'suppliers.id', '=', 'device_reviews.supplier_id');
        $mainQuery->leftJoin('users', 'users.id', '=', 'plan_device_rating.user_id');
        $mainQuery->select(DB::raw('( 6371 * acos( cos( radians(' . $current_lat . ') ) * cos( radians( plan_device_rating.latitude ) ) * cos( radians( plan_device_rating.longitude ) - radians(' . $current_long . ') ) + sin( radians(' . $current_lat . ') ) * sin( radians( plan_device_rating.latitude ) ) ) ) AS distance'), 'plan_device_rating.device_id as id', 'plan_device_rating.longitude', 'plan_device_rating.latitude', 'device_reviews.price', 'plan_device_rating.average', 'users.is_active','device_reviews.average_review','brands.brand_name','brands.model_name','suppliers.supplier_name','device_reviews.storage');
        $mainQuery->where('plan_device_rating.device_id', '!=', 0);
        $mainQuery->whereNotNull('plan_device_rating.longitude')->whereNotNull('plan_device_rating.latitude');
        $mainQuery->where('device_reviews.country_code', $current_country_code);
        if ($filtersetting && $filtersetting->reviews_for_unverified == 0) {
            $mainQuery->where('users.is_active', 1);
        }
        $mainQuery->where(function ($query) use ($data) {
            if (array_key_exists("brand_name", $data) && $data['brand_name'] != "") {
                $query->orWhere('device_reviews.brand_id', $data['brand_name']);
            }
            if (array_key_exists("storage", $data) && $data['storage'] != "") {
                $query->orWhere('device_reviews.storage', $data['storage']);
            }
            if (array_key_exists("device_color", $data) && $data['device_color'] != "") {
                $query->orWhere('device_reviews.device_color', $data['device_color']);
            }
        });
        $searchResultCount = $mainQuery->count();
        if ($params['name'] == 'brand_name') {
            $mainQuery->orderBy('brands.' . $params['name'], $params['sort']);
        }
        if ($params['name'] == 'model_name') {
            $mainQuery->orderBy('brands.' . $params['name'], $params['sort']);
        }
        if ($params['name'] == 'supplier_name') {
            $mainQuery->orderBy('suppliers.' . $params['name'], $params['sort']);
        }
        if ($params['name'] == 'price' || $params['name'] == 'storage' || $params['name'] == 'distance') {
            if ($params['name'] != "distance") {
                $mainQuery->orderBy('device_reviews.' . $params['name'], $params['sort']);
            } else {
                $mainQuery->orderBy($params['name'], $params['sort']);
            }
        }
        $searchResult = $mainQuery->groupBy('plan_device_rating.device_id')->paginate($limit);
        if ($searchResult) {
            foreach ($searchResult as $key => $value) {
                $user_address = UserAddress::where('user_id', $searchResult[$key]['user_id'])->where('is_primary', 1)->value('formatted_address');
                $searchResult[$key]['user_address'] = $user_address;
            }
        }
        return view('FrontEnd.devices.devicesSorting', ['data' => $searchResult, 'filtersetting' => $filtersetting, 'ads' => $ads, 'googleads' => $googleads]);
    }
    public function deviceDetails($id) {
        $planDetailData = DeviceReview::where('id', $id)->with('device', 'brand', 'supplier', 'currency', 'device_color_info')->first();
        $allratings = $planDetailData->get_ratings($id);
        $plan_device_rating = $planDetailData->plan_device_rating->toArray();
        $user_address = UserAddress::where('user_id', $planDetailData->user_id)->where('is_primary', 1)->value('formatted_address');
        $planDetailData->user_address = $user_address;
        $key = [];
        $blankArray = [];
        foreach ($allratings as $ratings) {
            if ($ratings->entity_id == $planDetailData->id && $ratings->entity_type == 2) { //Check entity id is equal to plan id
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
        foreach ($plan_device_rating as $plan_device) {
            if ($plan_device['device_id'] == $planDetailData->id) { //Check plan_id is equal to plan id
                $address = UserAddress::find($plan_device['user_address_id']);
                if (isset($address['formatted_address']) != NULL && $address['formatted_address'] != '') {
                    $blankArray[$plan_device['rating_id']]['formatted_address'] = $address['city'] . ' ' . $address['country'] . ' ' . $address['postal_code'];
                } else {
                    $blankArray[$plan_device['rating_id']]['formatted_address'] = 'N/A';
                }
                $blankArray[$plan_device['rating_id']]['date'] = $plan_device['created_at'];
                $blankArray[$plan_device['rating_id']]['comment'] = $plan_device['comment'];
                $blankArray[$plan_device['rating_id']]['average'] = $plan_device['average'];
                $blankArray[$plan_device['rating_id']]['user_address_id'] = $plan_device['user_address_id'];
            }
        }
        $planDetailData->ratings = $blankArray;
        return view('FrontEnd.deviceDetail', ['service' => $planDetailData]);
    }
    public function searchBrand(Request $request) {
        $params = $request->all();
        $brands = Brands::where('brand_name', 'LIKE', '%' . $params['search'] . '%')->get()->toArray();
        if ($brands) {
            $message = array('sucess' => true, 'data' => $brands);
            echo json_encode($message);
        } else {
            $message = array('sucess' => false, 'data' => null);
            echo json_encode($message);
        }
    }
}

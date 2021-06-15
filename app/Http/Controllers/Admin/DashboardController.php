<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\AdminModel;
use App\Models\FrontEnd\ServiceReview;
use App\Models\FrontEnd\DeviceReview;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard with plans-review, device-review, admins, users, blogs count
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $data['plansReviews'] = ServiceReview::count();
        $data['deviceReviews'] = DeviceReview::count();
        $data['admins'] = AdminModel::Where('type',2)->count();
        $data['users'] = User::count();
        $data['blogs'] = BlogsModel::count();
        return view('Admin.dashboard',['data'=>$data]);
    }
}

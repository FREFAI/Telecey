<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\AdminModel;

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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $data['admins'] = AdminModel::Where('type',2)->count();
        $data['users'] = User::count();
        $data['blogs'] = BlogsModel::count();
        return view('Admin.dashboard',['data'=>$data]);
    }
}

<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\BlogsModel;
use App\Models\Admin\SettingsModel;

class BlogsController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function blogs()
    {
        $blogs = BlogsModel::orderBy('created_at','DESC')->paginate(10);
        return view('FrontEnd.blogs',['blogs'=>$blogs]);
    }
}

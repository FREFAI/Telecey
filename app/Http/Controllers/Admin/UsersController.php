<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
    	$users = User::orderBy('id','DESC')->paginate(10);
    	foreach ($users as $user) {
    		$plans = $user->plans;
    		foreach ($plans as $plan) {
    			$plan->provider;
    		}
    		$user->unApprovedCount = $user->getUnapprovedProviders()->count();
    		$user->plansCount = $user->plans->count();
    		$user->devicesCount = $user->devices->count();
    	}
    	// echo "<pre>";print_r($users->toArray()); exit;
    	return view('Admin.Users.users-list',['users'=>$users]);
    }
}

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Static Designs Start Here
	// Route::get('/', function () {
	//     return view('FrontEnd.homepage');
	// });
	// Route::get('/plans', function () {
	//     return view('FrontEnd.plans');
	// });
	// Route::get('/devices', function () {
	//     return view('FrontEnd.devices');
	// });
	// Route::get('/blogs', function () {
	//     return view('FrontEnd.blogs');
	// });
	Route::get('/reviews', function () {
	    return view('FrontEnd.reviews');
	});
	Route::get('/signin', function () {
	    return view('FrontEnd.LoginSignup.login');
	});
	Route::get('/signup', function () {
	    return view('FrontEnd.LoginSignup.signup');
	});
// Static Designs End Here




// FrontEnd Section 
	Route::get('/', 'FrontEnd\HomeController@homepage');
	Route::get('/plans', 'FrontEnd\PlansController@plans');
	Route::get('/devices', 'FrontEnd\DevicesController@devices');
	Route::get('/blogs', 'FrontEnd\BlogsController@blogs');
	Route::get('/reviews', 'FrontEnd\ReviewsController@reviews');
// End FrontEnd Section 





// Admin Section
	Route::get('/home', 'HomeController@index')->name('home');
	Auth::routes();

	Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
	Route::post('/admin/login', 'Admin\LoginController@authenticate');
	Route::get('/admin/signup', 'Admin\RegisterController@showSignupForm');
	Route::post('/admin/signup', 'Admin\RegisterController@registerAdmin');
	Route::get('/admin/forgotpassword', 'Admin\ForgotPasswordController@showForgotPasswordForm');
	Route::post('/admin/forgotpassword', 'Admin\ForgotPasswordController@sendEmail');
	Route::get('/admin/resetPassword/{token}', 'Admin\ForgotPasswordController@setPasswordForm');
	Route::post('/admin/resetPassword', 'Admin\ForgotPasswordController@setPassword');

	Route::group(['prefix' => 'admin','middleware' => 'auth:admin'], function(){
		Route::get('/dashboard', 'Admin\DashboardController@dashboard');
		Route::get('/logout', 'Admin\LoginController@logout');
		Route::get('/settings', 'Admin\SettingsController@allSetting');
		Route::post('/settings', 'Admin\SettingsController@changeSetting');
	});
// End Admin Section
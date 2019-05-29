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
	Auth::routes();
	Route::group(['prefix' => 'admin'], function(){
		Route::get('/', 'Admin\LoginController@showLoginForm');
		Route::get('/login', 'Admin\LoginController@showLoginForm')->name('admin.login');

		Route::post('/login', 'Admin\LoginController@authenticate');
		Route::get('/signup', 'Admin\RegisterController@showSignupForm');
		Route::post('/signup', 'Admin\RegisterController@registerAdmin');
		Route::get('/forgotpassword', 'Admin\ForgotPasswordController@showForgotPasswordForm');
		Route::post('/forgotpassword', 'Admin\ForgotPasswordController@sendEmail');
		Route::get('/resetPassword/{token}', 'Admin\ForgotPasswordController@setPasswordForm');
		Route::post('/resetPassword', 'Admin\ForgotPasswordController@setPassword');



		Route::group(['middleware' => 'auth:admin'], function(){
			Route::get('/dashboard', 'Admin\DashboardController@dashboard');
			Route::get('/logout', 'Admin\LoginController@logout');
			// Settings Section
				Route::get('/settings', 'Admin\SettingsController@allSetting');
				Route::post('/settings', 'Admin\SettingsController@changeSetting');
				Route::get('/filetrsettings', 'Admin\FilterSettingsController@allFilterSetting');
				Route::post('/filetrsettings', 'Admin\FilterSettingsController@changeFilterSetting');
			// End Settings Section

			// Ads Route Section 
				Route::get('/ads', 'Admin\AdsController@addAdsForm');
				Route::post('/ads', 'Admin\AdsController@addAds');
				Route::post('/delete_ads', 'Admin\AdsController@deleteAds');
			// End Ads Route Section 
		});


		
	});
// End Admin Section
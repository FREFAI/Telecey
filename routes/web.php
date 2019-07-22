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
// Testing Route 
	Route::get('/county', 'TestController@index');

// End Testing Route 


// FrontEnd Section 
	Route::get('/', 'FrontEnd\HomeController@homepage');
	// Login and Sign Up section
	
		Route::get('/signin', 'FrontEnd\LoginSignup\LoginController@showLoginForm');
		Route::post('/signin', 'FrontEnd\LoginSignup\LoginController@authenticate');
		Route::get('/signup', 'FrontEnd\LoginSignup\RegisterController@signupWithFbAndGoogleForm');

		// Forgot password

		Route::get('/forgot-password', 'FrontEnd\LoginSignup\ForgotPasswordController@forgotPasswordForm');
		Route::post('/forgot-password', 'FrontEnd\LoginSignup\ForgotPasswordController@sendEmail');
		Route::get('/resetPassword/{token}', 'FrontEnd\LoginSignup\ForgotPasswordController@setPasswordForm');
		Route::post('/resetPassword', 'FrontEnd\LoginSignup\ForgotPasswordController@setPassword');
		
		
		// End Forgot password
		// Signup section
		Route::get('/emailsignup', 'FrontEnd\LoginSignup\RegisterController@signupForm');
		Route::post('/emailsignup', 'FrontEnd\LoginSignup\RegisterController@registerUser');
		// Google login
		Route::get('/googlelogin', 'FrontEnd\LoginSignup\SocialAuthGoogleController@redirect');
		Route::get('/googlecallback', 'FrontEnd\LoginSignup\SocialAuthGoogleController@callback');

		// Facebook Login
		Route::get('/facebooklogin', 'FrontEnd\LoginSignup\SocialAuthFacebookController@redirect');
		Route::get('/facebookcallback', 'FrontEnd\LoginSignup\SocialAuthFacebookController@callback');
		// Confirm email
		Route::get('/confirmEmail/{token}', 'FrontEnd\LoginSignup\RegisterController@confirmEmail');
		
	// End Login and Sign Up section

	Route::get('/plans', 'FrontEnd\PlansController@plans');
	Route::get('/devices', 'FrontEnd\DevicesController@devices');
	Route::get('/blogs-list', 'FrontEnd\BlogsController@blogs');

	Route::group(['middleware' => 'CustomerAuth'], function(){
		Route::group(['middleware' => 'IpLocation'], function(){
			// Change password
			Route::post('/changePassword', 'FrontEnd\LoginSignup\ForgotPasswordController@changePassword');
			// Change password
			// Change address
			Route::post('/getAddress', 'FrontEnd\HomeController@getAddress');
			Route::post('/changeAddress', 'FrontEnd\HomeController@changeAddress');
			// Change address
			Route::post('/getCountry', 'FrontEnd\ReviewsController@getCountry');
			Route::get('/reviews', 'FrontEnd\ReviewsController@reviews');
			Route::post('/getModels', 'FrontEnd\BrandsController@getModels');
			Route::get('/reviews/{planId}', 'FrontEnd\ReviewsController@reviewsRating');
			Route::post('/reviewsDetail', 'FrontEnd\ReviewsController@reviewsDetail');
			Route::post('/reviewService', 'FrontEnd\ReviewsController@reviewService');
			Route::post('/saveSpeedTest', 'FrontEnd\ReviewsController@saveSpeedTest');
			Route::post('/ratingService', 'FrontEnd\ReviewsController@ratingService');
			Route::get('/profile', 'FrontEnd\HomeController@profile');
			Route::get('/logout', 'FrontEnd\LoginSignup\LoginController@logout');
			Route::post('/reviewDevice', 'FrontEnd\DeviceReviewController@reviewDevice');
		});
	});

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

			// Home content section

				Route::get('/home-content', 'Admin\HomeController@index');
				
			// End Home content section

			// Blog Section  

				Route::get('/blogs', 'Admin\BlogsController@index');
				Route::get('/addblog', 'Admin\BlogsController@addBlogForm');
				Route::post('/addblog', 'Admin\BlogsController@addBlog');
				Route::get('/editblog/{blogID}', 'Admin\BlogsController@editBlogForm');
				Route::get('/single-blog/{blogID}', 'Admin\BlogsController@viewBlog');
				Route::post('/editblog', 'Admin\BlogsController@editBlog');
				Route::post('/deleteBlog', 'Admin\BlogsController@deleteBlog');

			// End Blog Section 

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

			// Providers Section
				Route::get('/addprovider', 'Admin\ProviderController@addProviderForm');
				Route::post('/addprovider', 'Admin\ProviderController@addProvider');
				Route::get('/provider-list', 'Admin\ProviderController@providerList');
				Route::get('/editprovider/{providerId}', 'Admin\ProviderController@editProviderForm');
				Route::post('/updateprovider', 'Admin\ProviderController@editProvider');
				Route::post('/deleteProvider', 'Admin\ProviderController@deleteProvider');
				Route::post('/approveProvider', 'Admin\ProviderController@approveProvider');
			// End Providers Section

			// Service type Section
				Route::get('/addservicetype', 'Admin\ServiceTypeController@addServiceTypeForm');
				Route::post('/addservicetype', 'Admin\ServiceTypeController@addServiceType');
				Route::get('/servicetype-list', 'Admin\ServiceTypeController@serviceTypeList');
				Route::get('/editservicetype/{servicetypeId}', 'Admin\ServiceTypeController@editServiceTypeForm');
				Route::post('/updateservicetype', 'Admin\ServiceTypeController@editServiceType');
				Route::post('/deleteServicetype', 'Admin\ServiceTypeController@deleteServicetype');
			// End Service type Section

			// Rating question section 
				Route::get('/rating-question','Admin\RatingQuestionController@questionList');
				Route::get('/add-question','Admin\RatingQuestionController@addRatingQuestionForm');
				Route::post('/add-question','Admin\RatingQuestionController@addRatingQuestion');
				Route::get('/edit-question/{questionId}','Admin\RatingQuestionController@editRatingQuestionForm');
				Route::post('/edit-question','Admin\RatingQuestionController@editRatingQuestion');
				Route::post('/delete-question', 'Admin\RatingQuestionController@deleteRatingQuestion');
			// End Rating question section 

			// Devices Section  
				Route::get('/devices-list','Admin\DevicesController@devicesList');
				Route::get('/add-device','Admin\DevicesController@addDevicesForm');
				Route::post('/add-device','Admin\DevicesController@addDevices');
				Route::get('/edit-device/{deviceId}','Admin\DevicesController@editDevicesForm');
				Route::post('/edit-device','Admin\DevicesController@editDevices');
				Route::post('/delete-device', 'Admin\DevicesController@deleteDevices');
			// End Devices Section  

			// Brands Section  
				Route::get('/brands-list','Admin\BrandsController@brandsList');
				Route::get('/add-brand','Admin\BrandsController@addBrandForm');
				Route::post('/add-brand','Admin\BrandsController@addBrand');
				Route::get('/edit-brand/{deviceId}','Admin\BrandsController@editBrandForm');
				Route::post('/edit-brand','Admin\BrandsController@editBrand');
				Route::post('/delete-brand', 'Admin\BrandsController@deleteBrand');
			// End Brands Section  
			// Brands Model Section  
				Route::get('/brand-models/{brandId}','Admin\BrandsModelController@brandModelsList');
				Route::get('/add-brand-models/{brandId}','Admin\BrandsModelController@addBrandModelsForm');
				Route::post('/add-brand-model','Admin\BrandsModelController@addBrandModels');
				Route::get('/edit-brand-model/{brandId}','Admin\BrandsModelController@editBrandModelsForm');
				Route::post('/edit-brand-model','Admin\BrandsModelController@editBrandModels');
				Route::post('/delete-model','Admin\BrandsModelController@deleteBrandModel');
			// End Brands Model Section  
		});


		
	});
// End Admin Section
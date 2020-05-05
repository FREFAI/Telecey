<?php
ini_set('upload_max_filesize', '256M');
ini_set('post_max_size', '256M');
ini_set('max_execution_time', '900');
ini_set('memory_limit', '256M');
ini_set('max_input_time', '900');
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
	Route::get('/country', 'TestController@index');

// Start Independent Routes
	Route::get('/addNikNameIfNotExist', 'IndependentController@addNikNameIfNotExist');
	Route::get('/addressMigration', 'IndependentController@addressMigration');
// End Independent Routes
	Route::get('/testEmail', 'TestController@testEmail');
	Route::post('/updateUserAddressTable', 'IndependentController@updateUserAddressTable');
	Route::get('/fixedOldPlanDataIssue', 'IndependentController@fixedOldPlanDataIssue');
	Route::get('/fixedOldDeviceDataIssue', 'IndependentController@fixedOldDeviceDataIssue');
	// End Testing Route 
	Route::get('/cookieSet', 'IndependentController@cookieSet');


// FrontEnd Section 
	Route::get('/home', 'FrontEnd\HomeController@homepage');
	// New Design Route
	Route::get('/', 'FrontEnd\HomeController@homePageNew');
	Route::get('/plans', 'FrontEnd\PlansController@plansNew');
	Route::get('/plans/result', 'FrontEnd\PlansController@plansResult');
	Route::post('/plans/resultSorting', 'FrontEnd\PlansController@plansResultSorting');
	Route::get('/devices', 'FrontEnd\DevicesController@devicesNew');
	Route::get('/devices/result', 'FrontEnd\DevicesController@devicesResult');
	Route::post('/devices/resultSorting', 'FrontEnd\DevicesController@devicesResultSorting');
	Route::get('/blogs-list', 'FrontEnd\BlogsController@blogsNew');
	// End New Design Route

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

	Route::get('/plans-new', 'FrontEnd\PlansController@plans');
	Route::get('/devices-new', 'FrontEnd\DevicesController@devices');
	Route::get('/blogs-list-new', 'FrontEnd\BlogsController@blogs');
	Route::get('/searchBrand', 'FrontEnd\DevicesController@searchBrand');

	// Brand Section
	Route::post('/getBrandColor', 'FrontEnd\BrandsController@getBrandColor');
	// End Brand Section
	
	Route::get('/single-blog/{id}', 'FrontEnd\BlogsController@blogDetail');
	Route::group(['middleware' => ['CustomerAuth','PreventBackHistory']], function(){
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
			Route::get('/reviews/{planId}', 'FrontEnd\ReviewsController@reviewsRating');
			Route::post('/getModels', 'FrontEnd\BrandsController@getModels');
			Route::post('/reviewsDetail', 'FrontEnd\ReviewsController@reviewsDetail');
			Route::post('/reviewService', 'FrontEnd\ReviewsController@reviewService');
			Route::post('/saveSpeedTest', 'FrontEnd\ReviewsController@saveSpeedTest');
			Route::post('/ratingService', 'FrontEnd\ReviewsController@ratingService');
			Route::get('/profile', 'FrontEnd\HomeController@profile');
			Route::get('/add-blog', 'FrontEnd\BlogsController@addBlogForm');
			Route::post('/add-blog', 'FrontEnd\BlogsController@addBlog');
			Route::get('/edit-blog/{id}', 'FrontEnd\BlogsController@editBlogForm');
			Route::post('/edit-blog', 'FrontEnd\BlogsController@editBlog');
			Route::post('/deleteBlog', 'FrontEnd\BlogsController@deleteBlog');
			Route::get('/blog-list', 'FrontEnd\BlogsController@blogList');
			Route::get('/logout', 'FrontEnd\LoginSignup\LoginController@logout');
			Route::get('/planDetails/{id}', 'FrontEnd\PlansController@planDetails');
			Route::get('/deviceDetails/{id}', 'FrontEnd\DevicesController@deviceDetails');
			

			// Device Section 
			Route::post('/reviewDevice', 'FrontEnd\DeviceReviewController@reviewDevice');
			Route::post('/ratingDevice', 'FrontEnd\DeviceReviewController@ratingDevice');
			Route::get('/device-review/{deviceId}', 'FrontEnd\DeviceReviewController@deviceReviewsRating');
			// End Device Section 

			// Suport case section
			Route::get('/contact-us', 'FrontEnd\SupportCaseController@index');
			Route::post('/generateCase', 'FrontEnd\SupportCaseController@generateCase');
			Route::get('/inbox/{caseID}', 'FrontEnd\SupportCaseController@caseInbox');
			Route::post('/sendMessage', 'FrontEnd\SupportCaseController@sendMessage');
			// End Suport case section
			
			// Email verify Section
			Route::get('/resendVerifyEmail', 'FrontEnd\LoginSignup\RegisterController@resendVerifyEmail');
			// End Email verify Section
			
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



		Route::group(['middleware' => ['auth:admin','PreventBackHistory']], function(){
			Route::get('/dashboard', 'Admin\DashboardController@dashboard');
			Route::get('/logout', 'Admin\LoginController@logout');
			// Users Section 
			Route::get('/users', 'Admin\UsersController@index');
			Route::get('/userSorting', 'Admin\UsersController@userSorting');
			Route::post('/getAllEmailsOfUsers','Admin\SendEmailsController@getAllEmailsOfUsers');
			// Route::post('/users', 'Admin\UsersController@searchUser');
			Route::get('/userDetail/{userId}', 'Admin\UsersController@getSingleUserDetail');
			Route::get('/forgotEmail/{userId}', 'Admin\ForgotPasswordController@sendEmailManually');
			Route::post('/sendEmailToUsers', 'Admin\SendEmailsController@sendEmailToUsers');
			// End Users Section 

			// Sub Admin Section
			Route::get('/add-admin', 'Admin\RegisterController@registerSubAdminForm');
			Route::post('/add-admin', 'Admin\RegisterController@registerSubAdmin');
			Route::get('/edit-admin/{adminID}', 'Admin\RegisterController@editSubAdminForm');
			Route::post('/edit-admin', 'Admin\RegisterController@editSubAdmin');
			Route::post('/delete-admin', 'Admin\RegisterController@deleteSubAdmin');
			Route::get('/admin-list', 'Admin\RegisterController@subAdminList');
			Route::post('/approveOrUnapproveAdmin', 'Admin\RegisterController@approveOrUnapproveAdmin');
			// End Sub Admin Section

			// Home content section

				Route::get('/home-content', 'Admin\HomeController@index');
				Route::post('/section-one', 'Admin\HomeController@sectionOne');
				Route::post('/section-two', 'Admin\HomeController@sectionTwo');
				Route::post('/section-three', 'Admin\HomeController@sectionThree');
				Route::post('/section-four', 'Admin\HomeController@sectionFour');
				Route::post('/section-five', 'Admin\HomeController@sectionFive');
				Route::post('/section-sixth', 'Admin\HomeController@sectionSix');
				
			// End Home content section
			// Terms Adn Conditions content section

				Route::get('/terms-conditions', 'Admin\HomeController@termsAndConditionsForm');
				Route::post('/terms-conditions', 'Admin\HomeController@termsAndConditions');
				
			// End Terms Adn Conditions content section

			// Blog Section 

				Route::get('/blogs', 'Admin\BlogsController@index');
				Route::get('/addblog', 'Admin\BlogsController@addBlogForm');
				Route::post('/addblog', 'Admin\BlogsController@addBlog');
				Route::get('/editblog/{blogID}', 'Admin\BlogsController@editBlogForm');
				Route::get('/single-blog/{blogID}', 'Admin\BlogsController@viewBlog');
				Route::post('/editblog', 'Admin\BlogsController@editBlog');
				Route::post('/deleteBlog', 'Admin\BlogsController@deleteBlog');
				Route::post('/approveBlog', 'Admin\BlogsController@approveBlog');
			// End Blog Section
			// Categories Section 

				Route::get('/categories', 'Admin\CategoriesController@index');
				Route::get('/addcategories', 'Admin\CategoriesController@addCategoryForm');
				Route::post('/addcategories', 'Admin\CategoriesController@addCategory');
				Route::get('/editcategories/{categoriesID}', 'Admin\CategoriesController@editCategoryForm');
				Route::post('/editcategories', 'Admin\CategoriesController@editCategory');
				Route::post('/deleteCategories', 'Admin\CategoriesController@deleteCategory');
				

			// End Categories Section

			// Classes Section

			Route::get('/classes', 'Admin\ClassesController@index');
			Route::get('/addClass', 'Admin\ClassesController@addClassForm');
			Route::post('/addClass', 'Admin\ClassesController@addClass');
			Route::get('/editClass/{id}/{page}', 'Admin\ClassesController@editClass');
			Route::post('/editClass', 'Admin\ClassesController@editClassMethod');
			Route::post('/deleteClass', 'Admin\ClassesController@deleteClass');

			// Classes Section

			// Settings Section
				Route::post('/addNoSearchMessage', 'Admin\SettingsController@addNoSearchMessage');
				Route::get('/settings', 'Admin\SettingsController@allSetting');
				Route::post('/settings', 'Admin\SettingsController@changeSetting');
				Route::post('/addSearchRecordLimit', 'Admin\SettingsController@addSearchRecordLimit');
				Route::post('/addBlogImageLimit', 'Admin\SettingsController@addBlogImageLimit');
				Route::post('/addHomeImageLimit', 'Admin\SettingsController@addHomeImageLimit');
				Route::get('/filetrsettings', 'Admin\FilterSettingsController@allFilterSetting');
				Route::post('/filetrsettings', 'Admin\FilterSettingsController@changeFilterSetting');
			// End Settings Section

			// Ads Route Section 
				Route::get('/ads', 'Admin\AdsController@addAdsForm');
				Route::post('/ads', 'Admin\AdsController@addAds');
				Route::get('/editAds/{adsId}', 'Admin\AdsController@editAdsForm');
				Route::post('/editAds', 'Admin\AdsController@editAds');
				Route::post('/delete_ads', 'Admin\AdsController@deleteAds');
				Route::post('/approveAds', 'Admin\AdsController@approveAds');
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
				Route::post('/set-default-device', 'Admin\DevicesController@setDefaultDevice');
				Route::get('/colors-list','Admin\DevicesController@deviceColorList');
				Route::get('/add-color','Admin\DevicesController@addColorForm');
				Route::post('/add-color','Admin\DevicesController@addColor');
				Route::get('/edit-color/{colorId}','Admin\DevicesController@editColorForm');
				Route::post('/edit-color','Admin\DevicesController@editColor');
				Route::post('/delete-color','Admin\DevicesController@deleteColor');
			// End Devices Section  

			// Brands Section  
				Route::get('/brands-list','Admin\BrandsController@brandsList');
				Route::get('/add-brand','Admin\BrandsController@addBrandForm');
				Route::post('/add-brand','Admin\BrandsController@addBrand');
				Route::get('/edit-brand/{deviceId}','Admin\BrandsController@editBrandForm');
				Route::post('/edit-brand','Admin\BrandsController@editBrand');
				Route::post('/delete-brand', 'Admin\BrandsController@deleteBrand');
				Route::post('/set-default-model', 'Admin\BrandsController@setDefaultModel');
				Route::post('/approveBrand','Admin\BrandsController@approveBrand');
			// End Brands Section  
			// Brands Model Section  
				// Route::get('/brand-models/{brandId}','Admin\BrandsModelController@brandModelsList');
				// Route::get('/add-brand-models/{brandId}','Admin\BrandsModelController@addBrandModelsForm');
				// Route::post('/add-brand-model','Admin\BrandsModelController@addBrandModels');
				// Route::get('/edit-brand-model/{brandId}','Admin\BrandsModelController@editBrandModelsForm');
				// Route::post('/edit-brand-model','Admin\BrandsModelController@editBrandModels');
				// Route::post('/delete-model','Admin\BrandsModelController@deleteBrandModel');
			// End Brands Model Section 

			// Messages section  
				Route::get('/messages','Admin\SupportCaseController@index');
				// Route::post('/messages','Admin\SupportCaseController@searchCases');
				Route::get('/inbox/{caseID}','Admin\SupportCaseController@caseInbox');
				Route::post('/sendMessage', 'Admin\SupportCaseController@sendMessage');
				Route::post('/closeCaseRequest', 'Admin\SupportCaseController@closeCaseRequest');
			// End Messages section  

			// Supplier section 
				Route::get('/suppliers','Admin\SupplierController@supplierList');
				Route::get('/add-supplier','Admin\SupplierController@addSupplierForm');
				Route::post('/addsupplier','Admin\SupplierController@addSupplier');
				Route::get('/edit-supplier/{supplierID}','Admin\SupplierController@editSupplierForm');
				Route::post('/editsupplier','Admin\SupplierController@editSupplier');
				Route::post('/delete-supplier','Admin\SupplierController@deleteSupplier');
				Route::post('/approveSupplier','Admin\SupplierController@approveSupplier');
				Route::post('/set-default-supplies', 'Admin\SupplierController@setDefaultSupplies');
				Route::get('/exportUsers', 'Admin\UsersController@exportUsers');
			// End Supplier section 



			// Start Logs Section 
				Route::get('/adminLogs', 'Admin\LogsController@adminLog');
				Route::get('/userLogs', 'Admin\LogsController@userLog');
			// End Logs Section 
		});


		
	});
// End Admin Section
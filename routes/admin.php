<?php

use Illuminate\Support\Facades\Route;

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

/*
|--------------------------------------------------------------------------
| CMS routes for guests admin
|--------------------------------------------------------------------------
|
*/

Route::get('/admin', function(){
	return redirect()->route('admin.login');
});

Route::middleware(['guest:admin', 'admin_content'])->prefix('admin')->namespace('Cms')->name('admin.')->group(function () {

	// ADMIN LOGIN ROUTE
	Route::prefix('login')->controller('Auth\LoginController')->name('login')->group(function () {
		Route::get('/', 'showLoginForm');
		Route::post('/', 'login');
	});

});


/*
|--------------------------------------------------------------------------
| CMS routes for Authenticated Admin
|--------------------------------------------------------------------------
|
*/

Route::middleware(['auth:admin', 'set_admin_as_default_guard', 'admin_content'])->prefix('admin')->namespace('Cms')->name('admin.')->group(function () {

	// PROFILE PAGE
	Route::prefix('profile')->controller('Base\ProfileController')->name('profile')->group(function () {
		Route::get('/', 'edit')->name('.edit');
		Route::put('/', 'update')->name('.update');
		Route::put('/password', 'password')->name('.password');
	});

	// CMS SETTINGS
	Route::prefix('cms-settings')->controller('Base\CmsSettingController')->name('cms-settings')->group(function () {
		Route::get('/', 'edit');
		Route::put('/', 'update');
	});

	// ADMIN LOGOUT ROUTE
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	//============================================================

	// DASHBOARD
	Route::get('/dashboard', 'Base\DashboardController@index')->name('dashboard');

	// ADMINS MANAGEMENT
	Route::post('admins/block', 'Base\AdminController@block')->name('admins.block');
	Route::resource('admins', 'Base\AdminController', ['except' => ['show']]);	

	// ROLES
	Route::resource('roles', 'Base\RoleController');

	// PERMISSIONS
	Route::resource('permissions', 'Base\PermissionController', ['except' => ['show']]);
	
	Route::prefix('home-sliders')->name('home-sliders.')->group(function () {
		Route::post('/publish','HomeSliderController@publish')->name('publish');
		Route::get('/order', 'HomeSliderController@order')->name('order');
		Route::post('/order', 'HomeSliderController@orderSubmit');
	});
	Route::resource('home-sliders', 'HomeSliderController');//sidebar

	Route::resource('home-sections', 'HomeSectionController');

	Route::prefix('home-section-images')->name('home-section-images.')->group(function () {
		Route::post('/publish','HomeSectionImageController@publish')->name('publish');
		Route::get('/order', 'HomeSectionImageController@order')->name('order');
		Route::post('/order', 'HomeSectionImageController@orderSubmit');
	});
	Route::resource('home-section-images', 'HomeSectionImageController');//sidebar
	// SIMULATION
	Route::prefix('simulation')->controller('Base\SimulationController')->name('simulation.')->group(function () {
		Route::get('/', 'index')->name('index');
		Route::post('/', 'store')->name('store');
		Route::get('/destroy', 'destroy')->name('destroy');
	});

	//============================================================

	/*
	* USERS MANAGEMENT
	*/

	//============================================================

	/*
	* CONTENT MANAGEMENT
	*/

	// NEWS
	Route::prefix('news')->controller('NewsController')->name('news')->group(function () {
		Route::post('/publish', 'publish')->name('.publish');
	});
	Route::resource('news', 'NewsController');

	// FAQs
	Route::prefix('faqs')->controller('FaqController')->name('faqs')->group(function () {
		Route::post('/publish', 'publish')->name('.publish');
		Route::get('/order', 'order')->name('.order');
		Route::post('/order', 'orderSubmit');
	});
	Route::resource('faqs', 'FaqController');

	//============================================================

	/*
	* FORMS & SUBMISSIONS
	*/

	//============================================================

	/*
	* GENERAL MANAGEMENT
	*/

	// FIXED SECTIONS
	Route::resource('fixed-sections', 'Base\FixedSectionController');


	// SOCIAL MEDIAS
	Route::prefix('social-media')->controller('Base\SocialMediaController')->name('social-media')->group(function () {
		Route::post('/publish', 'publish')->name('.publish');
		Route::get('/order', 'order')->name('.order');
		Route::post('/order', 'orderSubmit');
	});
	Route::resource('social-media', 'Base\SocialMediaController');

	// TERMS
	Route::prefix('terms-and-conditions')->controller('Base\TermController')->name('terms-and-conditions')->group(function () {
		Route::get('/', 'edit');
		Route::put('', 'update');
	});

	// PRIVACY POLICY
	Route::prefix('privacy-policy')->controller('Base\PrivacyController')->name('privacy-policy')->group(function () {
		Route::get('/', 'edit');
		Route::put('/', 'update');
	});

	//============================================================

	/*
	* PLATFORM SETTINGS
	*/

	// PUSH NOTIFICATIONS
	Route::prefix('push-notifications')->controller('Base\PushNotificationController')->name('push-notifications')->group(function () {
		Route::get('/', 'index');
		Route::post('/bulk-push', 'bulk_push')->name('.bulk');
		Route::post('/single-push', 'single_push')->name('.single');		
	});

	// EMAIL NOTIFICATIONS
	Route::prefix('email-notifications')->controller('Base\EmailNotificationController')->name('email-notifications')->group(function () {
		Route::get('/', 'index');
		Route::post('/bulk-email', 'bulk_email')->name('.bulk');
		Route::post('/single-email', 'single_email')->name('.single');
	});
	// EMAIL NOTIFICATIONS VIEW
	// Route::get('/test', function(){
	// 	$subject = 'Email template notification';
	// 	$msg = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
	// 	$link = 'https://google.com';
	// 	$image = asset('assets-web/images/landing-page/bg.svg');
	// 	return view('emails.email-notifications', compact(
	// 		'subject',
	// 		'msg',
	// 		'link',
	// 		'image'
	// 	));
	// });

	// SMS NOTIFICATIONS
	Route::prefix('sms-notifications')->controller('Base\SmsNotificationController')->name('sms-notifications')->group(function () {
		Route::get('/', 'index');
		Route::post('/bulk-sms', 'bulk_sms')->name('.bulk');
		Route::post('/single-sms', 'single_sms')->name('.single');
	});

	// FORCE UPDATE
	Route::resource('force-update', 'Base\ForceUpdateController', ['only' => ['edit', 'update']]);

	// MAINTENANCE
	Route::prefix('maintenance')->controller('Base\MaintenanceController')->name('maintenance')->group(function () {
		Route::get('/', 'edit');
		Route::put('/', 'update');
		Route::get('/{id}/image/remove', 'imageRemove')->name('.image.remove');
	});

	// SETTINGS
	Route::prefix('settings')->controller('Base\SettingController')->name('settings')->group(function () {
		Route::get('/', 'edit');
		Route::put('/', 'update');
	});

});
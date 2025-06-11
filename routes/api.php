<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
|--------------------------------------------------------------------------
| Mobile app's routes
|--------------------------------------------------------------------------
|
*/

Route::namespace('Api')->group(function () {

    // AUTHENTICATION
    Route::group(['prefix' => 'user'], function () {
        Route::post('/login', 'Auth\LoginController@login');
        Route::post('/verification', 'Auth\VerificationController@verify');
    });

    // CONTACT
    Route::controller('ContactController')->group(function () {
        Route::get('support-categories', 'support_categories');
        Route::post('contact', 'contact');
    });

    // ABOUT
    Route::get('about', 'FixedSectionController@about');

    // SOCIAL MEDIA
    Route::get('social-media', 'SocialMediaController@index');

    // TERMS
    Route::get('terms', 'FixedSectionController@terms');

    // GENDERS
    Route::get('genders', 'GenderController@index');

    // DISTRICTS
    Route::get('districts', 'DistrictController@index');

    // CITIES
    Route::get('cities', 'CityController@index');

    // FORCE UPDATE
    Route::get('force-update', 'ForceUpdateController@index');

});

/*
|--------------------------------------------------------------------------
| Mobile app's routes for Authenticated Users
|--------------------------------------------------------------------------
|
*/

// You only need to specify the auth:sanctum middleware on any route that requires a valid access token.
Route::middleware(['auth:sanctum'])->namespace('Api')->group(function () {

    /*
    * USER ROUTES
    */
    Route::prefix('user')->controller('UserController')->group(function () {
        // USER PROFILE        
        Route::get('profile', 'profile');
        Route::post('profile/update', 'update');
        Route::post('delete', 'delete_account');

        // USER LOGOUT
        Route::get('logout', 'logout');
    });

    /*
	* ADDRESSES ROUTES
	*/
    Route::prefix('address')->controller('AddressController')->group(function () {
        Route::get('get', 'get');
        Route::post('add', 'add');
        Route::post('edit', 'edit');
        Route::post('delete', 'delete');
        Route::post('set-as-default', 'set_as_default');
    });

    /*
    * PUSH NOTIFICATION ROUTES
    */
    Route::prefix('push')->controller('PushController')->group(function () {
        Route::post('set-player-id', 'set_player_id');
        Route::get('inbox', 'inbox');
        Route::get('unread-count', 'unread_count');
    });

});
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

Route::get('/admin', function () {
    return redirect(route('admin.login'));
});

// LANDING PAGE ROUTE
Route::get('/', function () {
    return redirect()->route('web.home', 'en');
});


Route::namespace('Web')->middleware(['locale', 'footer'])->prefix('{locale}')->name('web.')->group(function () {
    // HOME
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/terms-conditions', 'HomeController@terms')->name('terms');
    Route::get('/privacy-policy', 'HomeController@privacy')->name('privacy');
});

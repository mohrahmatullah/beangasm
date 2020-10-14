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
Route::group(['prefix' => 'people',  'middleware' => 'checkLoginBuyer'], function()
{
    Route::get('/', 'BuyerController@index');
    Route::get('dashboard', 'Dashboard\DashboardController@index')->name('buyer-dashboard');
    Route::get('myorder', 'Dashboard\MyorderController@index')->name('buyer-myorder');
    Route::get('myorder-detail', 'Dashboard\MyorderController@detail')->name('buyer-myorder-detail');
    Route::get('wishlist', 'Dashboard\DashboardController@wishlist')->name('buyer-wishlist');
    Route::get('coupon', 'Dashboard\DashboardController@coupon')->name('buyer-coupon');
    Route::get('profile', 'Dashboard\DashboardController@profile')->name('buyer-profile');
});

Route::get('register', 'Auth\AuthController@register')->name('buyer-register');
Route::get('buyer-login', 'Auth\AuthController@getLoginBuyer')->name('buyer-login');
Route::post('buyer-login', 'Auth\AuthController@postLoginBuyer')->name('post-buyer-login');
Route::post('buyer-logout', 'Auth\AuthController@logoutFromLogin')->name('post-buyer-logout');

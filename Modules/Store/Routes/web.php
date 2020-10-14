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

Route::prefix('store')->group(function() {
    Route::get('/', 'StoreController@index');
    Route::get('dashboard', 'Dashboard\DashboardController@index')->name('store-dashboard');
    Route::get('myorder', 'Dashboard\DashboardController@myOrder')->name('store-myorder');
    Route::get('myorder-detail', 'Dashboard\DashboardController@myOrderDetail')->name('store-myorder-detail');
    Route::get('wishlist', 'Dashboard\DashboardController@wishlist')->name('store-wishlist');
    Route::get('coupon', 'Dashboard\DashboardController@coupon')->name('store-coupon');
    Route::get('profile', 'Dashboard\DashboardController@profile')->name('store-profile');
    Route::get('myproduct', 'Dashboard\DashboardController@myproduct')->name('store-myproduct');
    Route::get('orders', 'Dashboard\DashboardController@orders')->name('store-orders');
    Route::get('order-detail', 'Dashboard\DashboardController@orderDetail')->name('store-order-detail');
    Route::get('withdraw', 'Dashboard\DashboardController@withdraw')->name('store-withdraw');
    Route::get('reviews', 'Dashboard\DashboardController@reviews')->name('store-reviews');
    Route::get('notification', 'Dashboard\DashboardController@notification')->name('store-notification');
    Route::get('upload', 'Dashboard\DashboardController@upload')->name('store-upload');
    Route::post('upload', 'Dashboard\DashboardController@store')->name('store-upload-save');
    Route::get('delete', 'Dashboard\DashboardController@delete')->name('store-delete');
});
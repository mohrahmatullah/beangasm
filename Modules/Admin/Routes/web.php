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

Route::get('clear-cache', 'AdminController@index');

Route::group(['prefix' => 'kamicumaminumgeisha',  'middleware' => 'checkLoginBuyer'], function()
{
    Route::get('login', 'AdminController@index');
    Route::get('dashboard', 'Dashboard\DashboardController@index')->name('buyer-dashboard');
});

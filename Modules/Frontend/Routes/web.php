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

// Route::prefix('frontend')->group(function() {
//     Route::get('/', 'FrontendController@index');
// });

Route::get('/', 'Home\HomeController@index')->name('/');
Route::get('blog', 'Blog\BlogController@index')->name('blog');
Route::get('blog/{slug}', 'Blog\BlogController@details')->name('detail-blog');
Route::get('product', 'Product\ProductController@index')->name('product');
Route::get('product/{slug}', 'Product\ProductController@details')->name('detail-product');
Route::get('contact', 'Contact\ContactController@index')->name('contact');
Route::get('about', 'About\AboutController@index')->name('about');
Route::get('list-store', 'Store\StoreController@index')->name('list-store');
Route::get('list-store/{author}', 'Store\StoreController@details')->name('detail-list-store');
Route::get('search', 'Search\SearchController@index')->name('search');

Route::get('login', 'Home\HomeController@login')->name('login-user');
Route::get('signup', 'Home\HomeController@signup')->name('signup-user');

Route::get('remove_item/{cart_id}', 'Cart\CartController@doActionForRemoveItem')->name('removed-item-from-cart');
Route::get('checkout', 'Checkout\CheckoutController@checkoutPageContent')->name('checkout-page');

Route::post('checkout', 'Checkout\CheckoutController@doCheckoutProcess')->name('checkout-process');
Route::get( 'checkout/order-received/{order_id}/{order_key}', 'Checkout\CheckoutController@thankyouPageContent' )->name('frontend-order-received')->where('order_id', '[0-9]+');
Route::post('/ajax/add-to-cart', 'Ajax\AjaxController@productAddToCart')->name('product-add-to-cart');
Route::post('/ajax/get-mini-cart-data', 'Ajax\AjaxController@getMiniCartData')->name('mini-cart-data');
Route::post('/ajax/select-courier-to-shipping', 'Ajax\AjaxController@getCourierShipping')->name('select-courier-to-shipping');

Route::post('/ajax/get-search-suggestion-data', 'Ajax\AjaxController@getSearchSuggestion')->name('search-suggestion');
Route::post('/ajax/get-search-suggestion-store-data', 'Ajax\AjaxController@getSearchStoreSuggestion')->name('search-store-suggestion');
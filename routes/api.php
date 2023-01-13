<?php

use Illuminate\Http\Request;

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

// Public Routes

Route::post('login', 'Api\UserAccoutController@login')->name('api.login');
Route::post('register', 'Api\UserAccoutController@store')->name('api.register');
Route::post('resetpassword', 'Api\UserAccoutController@resetpassword')->name('api.resetpassword');
Route::post('changepassword', 'Api\UserAccoutController@changepassword')->name('api.changepassword');
Route::post('verifyotp', 'Api\UserAccoutController@verifyotp')->name('api.verifyotp');
// Private Routes

Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('logout', 'Api\UserAccoutController@logout')->name('api.logout');
    Route::get('accountdetails/{id}', 'Api\UserAccoutController@show')->name('api.accountdetails');
    Route::post('updateaccount/{id}', 'Api\UserAccoutController@update')->name('api.updateaccount');
    Route::post('updatepassword', 'Api\UserAccoutController@updatepassword')->name('api.updatepassword');

    Route::get('homeinfo', 'Api\HomeController@index')->name('api.homeinfo');

    Route::get('products', 'Api\ProductsController@search')->name('api.products');
    Route::get('product/{id}', 'Api\ProductsController@show')->name('api.product');

    Route::get('categories', 'Api\ProductsController@categories')->name('api.categories');
    Route::get('wishlists', 'Api\HomeController@wishlists')->name('api.wishlists');
    Route::get('addWishlist/{id}', "Api\HomeController@addwishlist")->name('api.addWishlist');
    Route::get('deleteWishlist/{id}', "Api\HomeController@deleteWishlist")->name('api.deleteWishlist');

    Route::post("contactseller", "Api\ProductsController@contactseller")->name('api.contactseller');

    Route::get('faqs', "Api\HomeController@faqs")->name('api.faqs');
    Route::get('notifications', 'Api\HomeController@notification')->name('api.notification');

    Route::get('/getpackages' , 'Api\ShopController@package' )->name('api.shop.package');
    Route::post('/registershops' , 'Api\ShopController@register' )->name('api.shop.register');
    Route::put('/updatepackage' , 'Api\ShopController@renew' )->name('api.shop.updatepackage');
    Route::get('/getsku/{num}' , 'Api\ShopController@generateSku' )->name('api.shop.getsku');
    Route::post('/addproducts' , 'Api\ShopController@addProducts' )->name('api.shop.addproducts');
    Route::post('/updateproducts/{id}' , 'Api\ShopController@updateProducts' )->name('api.shop.updateproducts');
});

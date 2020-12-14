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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/charges', 'ApiController@charges');


Route::get('/users', 'ApiController@users');
Route::get('/outlets', 'ApiController@outlets');
Route::prefix('outlet/id={outlet_id}')->group(function () {

    Route::get('/product/{id}', 'POSController@getProductById');
    Route::get('/hold-orders', 'POSController@getHoldOrders');
    Route::get('/customer-orders', 'POSController@getCustomerOrders');
    Route::get('/delete-order/{id}', 'POSController@deleteOrder');
    Route::post('/product-sku', 'POSController@getProductBySku');

    Route::get('/categories', 'ApiController@categories');
    Route::get('/products', 'ApiController@products');
    Route::get('/sells-man', 'ApiController@sellsMen');
    Route::get('/sells', 'ApiController@sells');
    Route::get('/payments','ApiController@outletPayments');
});






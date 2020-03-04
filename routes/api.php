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

Route::post('/auth/login', 'Api\\AuthController@login');

Route::group(['middleware' => ['apiJwt']], function() {
    
    // Clients
    Route::get('/clients', 'Api\\ClientController@index');
    Route::get('/clients/{client}', 'Api\\ClientController@show');
    Route::post('/clients/store', 'Api\\ClientController@store');
    Route::put('/clients/{client}', 'Api\\ClientController@update');
    
    // Products
    Route::get('/products', 'Api\\ProductController@index');
    Route::get('/products/{product}', 'Api\\ProductController@show');
    Route::post('/products/store', 'Api\\ProductController@store');
    Route::put('/products/{product}', 'Api\\ProductController@update');

    // Purchase Requests
    Route::get('/purchase-requests', 'Api\\PurchaseRequestController@index');
    Route::get('/purchase-requests/{purchase_request}', 'Api\\PurchaseRequestController@show');
    Route::post('/purchase-requests/store', 'Api\\PurchaseRequestController@store');
    Route::put('/purchase-requests/{purchase_request}', 'Api\\PurchaseRequestController@update');
    
    Route::post('/auth/logout', 'Api\\AuthController@logout');
});



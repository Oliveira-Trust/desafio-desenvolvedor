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
// Route::get('', 'Controller@checkWebServer');

Route::group(['middleware' => 'api'], function ($router) {
    // Auth routes
    Route::post('login', 'AuthController@login')->name('api.login');
    Route::post('register', 'AuthController@new');
    Route::get('refresh', 'AuthController@refresh');
    Route::get('logout', 'AuthController@logout')->name('api.logout');
    Route::get('check', 'AuthController@check');

    // Api routes
    Route::apiResources([
        'client' => 'ClientController',
        'product' => 'ProductController',
        'purchase' => 'PurchaseController',
    ]);
});

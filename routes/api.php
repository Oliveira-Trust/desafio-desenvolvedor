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
Route::post('login', 'API\AuthController@login')->name('api.login');
Route::post('register', 'API\AuthController@new');

Route::group(['middleware' => 'jwt'], function () {
    // Auth routes
    Route::get('refresh', 'API\AuthController@refresh');
    Route::get('logout', 'API\AuthController@logout')->name('api.logout');
    Route::get('me', 'API\AuthController@me');

    // Api routes
    Route::apiResources([
        'client' => 'API\ClientController',
        'product' => 'API\ProductController',
        'purchase' => 'API\PurchaseController',
    ]);
});

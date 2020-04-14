<?php

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

Route::group(['middleware' => 'api-header'], function () {

    // all routes that doesnt require authentication are registered here  

    Route::post('auth/login', 'AuthController@login');
    Route::post('auth/register', 'AuthController@register');
    Route::get('auth/by-token', 'AuthController@getUserByToken');
});

Route::group(['middleware' => ['jwt.auth','api-header']], function () {
  
    // all routes to protected resources are registered here  

    Route::patch('user/auth-update', 'UserController@updateAuthenticated');
    Route::post('user/avatar-upload', 'UserController@avatarUpload');
    Route::resource('user', 'UserController')->only(['show']);

    /**
    * /client        => 'GET'    @ index()
    * /client        => 'POST'   @ store()
    * /client/{id}   => 'GET'    @ show()
    * /client/{id}   => 'PATCH'  @ update()
    * /client/{id}   => 'DELETE' @ destroy()
    */
    Route::resource('client', 'ClientController');

    /**
    * /product        => 'GET'    @ index()
    * /product        => 'POST'   @ store()
    * /product/{id}   => 'GET'    @ show()
    * /product/{id}   => 'PATCH'  @ update()
    * /product/{id}   => 'DELETE' @ destroy()
    */
    Route::resource('product', 'ProductController');

    /**
    * /order        => 'GET'    @ index()
    * /order        => 'POST'   @ store()
    * /order/{id}   => 'GET'    @ show()
    * /order/{id}   => 'PATCH'  @ update()
    * /order/{id}   => 'DELETE' @ destroy()
    */
    Route::resource('order', 'OrderController');
});
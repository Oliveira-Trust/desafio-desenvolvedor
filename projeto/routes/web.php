<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest'], function() {
    /* Login */
    Route::get('/login', ['as' => 'login', 'uses' => 'AuthenticationController@showLogin']);
    Route::post('/login', [ 'as' => 'login-post', 'uses' => 'AuthenticationController@postLogin' ]);
});

Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('conversion/index');
    });

    /* Conversion */
    Route::get('/conversao/index', ['as' => 'index', 'uses' => 'ConversionController@showIndex']);
    Route::post('/conversao/envio-email', ['as' => 'sendMail', 'uses' => 'SendMailController@sendMail']);
    Route::post('/conversao/conversao', ['as' => 'conversion', 'uses' => 'ConversionController@conversion']);

    /* Logout */
    Route::get('/sair', ['as' => 'logout', 'uses' => 'AuthenticationController@doLogout']);

});

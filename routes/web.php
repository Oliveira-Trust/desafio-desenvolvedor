<?php

use App\Http\Middleware\AdminChecker as AdminChecker ;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WhatsappController;
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

Route::group(['namespace' => 'App\Http\Controllers'], function()
{   
    /**
     * Home Routes
     */
    Route::get('/', 'HomeController@index')->name('home.index');

    Route::group(['middleware' => ['guest']], function() {
        /**
         * Register Routes
         */
        Route::get('/register', 'RegisterController@show')->name('register.show');
        Route::post('/register', 'RegisterController@register')->name('register.perform');

        /**
         * Login Routes
         */
        Route::get('/login', 'LoginController@show')->name('login.show');
        Route::post('/login', 'LoginController@login')->name('login.perform');
        
        
        Route::post('/coin-ask/ask', 'App\Http\Controllers\CoinAskController@store')->name('ask-me');
    });

    Route::group(['middleware' => ['auth']], function() {
        /**
         * Logout Routes
         */
    Route::resource('/coins', 'App\Http\Controllers\CoinController')->middleware('App\Http\Middleware\AdminChecker');
    Route::resource('/configs', 'App\Http\Controllers\ConfigController')->middleware('App\Http\Middleware\AdminChecker');
    

    Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    Route::resource('/coin-asks', 'App\Http\Controllers\CoinAskController');
    });



});

Route::post('/coin-aks/ask', 'App\Http\Controllers\CoinAskController@store_public')->name('coin-ask-public');
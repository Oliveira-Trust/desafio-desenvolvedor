<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

Auth::routes();

Route::middleware('auth:web')->group(function () {
    Route::prefix('currency-exchange')->name('currency_exchange.')->group(function () {
        Route::get('convert', 'Web\CurrencyExchangeController@convert')->name('convert');
        Route::get('logs', 'Web\CurrencyExchangeController@logs')->name('logs');
    });

    Route::get('history', 'Web\CurrencyExchangeController@history')->name('history');
});


Route::get('home', 'Web\HomeController@index')->name('home');
Route::get('/', 'Web\HomeController@index');

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

Route::group(['middleware' => 'auth', 'namespace' => 'Conversion'], function () {
    Route::get('/', [
        'uses' => 'ConversionController@index'
    ]);

    Route::get('/conversion-history', [
        'as' => 'conversion-history.all',
        'uses' => 'ConversionHistoryController@all'
    ]);
});

Auth::routes();

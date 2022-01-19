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




Route::group(['middleware' => 'auth:sanctum'], function(){
    
    Route::get('/teste', 'TesteController@index');
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/quotation', 'ExchangeController@exchange')->name('quotation');
    Route::get('/quotations/getAll', 'QuotationController@getAll');
    Route::get('/quotations/getById', 'QuotationController@getAll');
    Route::get('/rates/update', 'RatesController@update');


});

<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'SiteController@apiTeste');
Route::post('/register', 'Auth\RegisterController@register')->name('api.register');
Route::post('/login', 'Auth\LoginController@login')->name('api.login');
Route::prefix('status')->group(function () {
    Route::post('/', 'API\StatusController@store')->name('api.status.create');
    Route::get('/{id}', 'API\StatusController@show')->name('api.status.show');
    Route::put('/{id}', 'API\StatusController@update')->name('api.status.update');
    Route::delete('/{id}', 'API\StatusController@delete')->name('api.status.delete');
    Route::get('/', 'API\StatusController@index')->name('api.status');
});
Route::prefix('cliente')->group(function () {
    Route::post('/', 'API\ClientController@store')->name('api.client.create');
    Route::get('/{id}', 'API\ClientController@show')->name('api.client.show');
    Route::put('/{id}', 'API\ClientController@update')->name('api.client.update');
    Route::delete('/{id}', 'API\ClientController@delete')->name('api.client.delete');
    Route::get('/', 'API\ClientController@index')->name('api.client');
});
Route::prefix('produto')->group(function () {
    Route::post('/', 'API\ProductController@store')->name('api.product.create');
    Route::get('/{id}', 'API\ProductController@show')->name('api.product.show');
    Route::put('/{id}', 'API\ProductController@update')->name('api.product.update');
    Route::delete('/{id}', 'API\ProductController@delete')->name('api.product.delete');
    Route::get('/', 'API\ProductController@index')->name('api.product');
});
Route::prefix('ordens')->group(function () {
    Route::post('/', 'API\OrderController@store')->name('api.orders.create');
    Route::get('/{id}', 'API\OrderController@show')->name('api.orders.show');
    Route::put('/{id}', 'API\OrderController@update')->name('api.orders.update');
    Route::delete('/{id}', 'API\OrderController@delete')->name('api.orders.delete');
    Route::get('/', 'API\OrderController@index')->name('api.orders');
});
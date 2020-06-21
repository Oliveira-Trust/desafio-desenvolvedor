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


Route::get('/', 'SiteController@index')->name('welcome');

Auth::routes();

Route::prefix('painel')->group(function () {
    Route::get('/', 'PainelController@index')->name('painel');
    Route::prefix('status')->group(function () {
        Route::get('/index', 'StatusController@allData')->name('status.index');
        Route::post('/', 'StatusController@store')->name('status.create');
        Route::get('/{id}', 'StatusController@show')->name('status.show');
        Route::get('/{id}/edit', 'StatusController@edit')->name('status.edit');
        Route::put('/{id}', 'StatusController@update')->name('status.update');
        Route::delete('/{id}', 'StatusController@delete')->name('status.delete');
        Route::get('/', 'StatusController@index')->name('status');
    });
    Route::prefix('cliente')->group(function () {
        Route::get('/index', 'ClientController@allData')->name('client.index');
        Route::post('/', 'ClientController@store')->name('client.create');
        Route::get('/{id}', 'ClientController@show')->name('client.show');
        Route::get('/{id}/edit', 'ClientController@edit')->name('client.edit');
        Route::put('/{id}', 'ClientController@update')->name('client.update');
        Route::delete('/{id}', 'ClientController@delete')->name('client.delete');
        Route::get('/', 'ClientController@index')->name('client');
    });
});
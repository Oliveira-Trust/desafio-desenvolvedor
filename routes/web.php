<?php

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

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth')->resource('clients', 'ClientController');
Route::middleware('auth')->resource('products', 'ProductController');
Route::middleware('auth')->resource('orders', 'OrderController');
//Route::post('clients/update', 'ClientController:update');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

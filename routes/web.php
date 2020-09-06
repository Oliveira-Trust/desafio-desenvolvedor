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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('products', 'ProductController');
Route::get('products/destroy/{id}', 'ProductController@destroy')->name('products.destroy');
Route::post('/products/search', 'ProductController@search')->name('products.search');

Route::resource('users', 'UserController');
Route::get('users/destroy/{id}', 'UserController@destroy')->name('users.destroy');
Route::post('/users/search', 'UserController@search')->name('users.search');
Route::get('/users/orders/{id}', 'UserController@orders')->name('users.orders');

Route::resource('orders', 'OrderController');
Route::post('/orders/search', 'OrderController@search')->name('orders.search');
Route::get('orders/destroy/{id}', 'OrderController@destroy')->name('orders.destroy');

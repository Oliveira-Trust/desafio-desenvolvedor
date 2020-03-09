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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->resource('client', 'ClientController');
Route::middleware('auth')->resource('product', 'ProductController');
Route::middleware('auth')->resource('order', 'OrderController');
Route::middleware('auth')->post('order/{order}/addProduct','OrderController@addProduct')->name('order.addProduct');
Route::middleware('auth')->post('order/{order}/removeProduct','OrderController@removeProduct')->name('order.removeProduct');
// Route::middleware('auth')->post('order/step2','OrderController@step2')->name('order.step2');
Route::middleware('auth')->get('order/step2/{order?}','OrderController@step2')->name('order.step2');
Route::middleware('auth')->post('order/{order}/commit','OrderController@commit')->name('order.commit');
Route::middleware('auth')->post('order/{order}/confirmPayment','OrderController@confirmPayment')->name('order.confirmPayment');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

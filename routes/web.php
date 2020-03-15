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

Route::get('/', 'HomeController@index')->name('index');
Route::get('/home', 'HomeController@index')->name('home');

Route::delete('/product/deletar', 'ProductController@deleteAll')->name('product.delmassa');
Route::resource('product', 'ProductController')->middleware('auth');
Route::delete('/product/{id}/photo', 'ProductController@destroyImage')->name('product.delphoto');
Route::get('/products', 'ProductController@showAll')->name('product.products');

Route::prefix('user')->name('user.')->middleware(['auth'])->group(function (){

    Route::get('me', 'UserController@me')->name('me');
    Route::put('me', 'UserController@meUpdate')->name('change');
    Route::delete('me', 'UserController@meDelete')->name('delete');

});

Route::resource('user', 'UserController');

Route::prefix('cart')->name('cart.')->group(function (){

    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');

    Route::get('{id}/remove', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');

});

Route::get('order/finally', 'OrderController@finallyOrder')->name('order.finally');
Route::get('orders', 'OrderController@ordersAll')->name('order.all');
Route::resource('order', 'OrderController');
Route::get('order/{id}/cancel', 'OrderController@cancel')->name('order.cancel');
Route::get('order/{id}/aproved', 'OrderController@aproved')->name('order.aproved');

Auth::routes();



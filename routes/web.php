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

Route::group(['middleware' => ['auth']], function() {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/client', 'ClientController@formView')->name('formViewClient');
    Route::get('/client/{user_id}', 'ClientController@formEdit')->name('formEditClient');


    Route::get('/product', 'ProductController@formView')->name('formViewProduct');
    Route::get('/product/{product_id}', 'ProductController@formEdit')->name('formEditProduct');
    Route::get('/productt/create', 'ProductController@formCreate');


    Route::get('/order', 'OrderController@formView')->name('formViewOrder');
    Route::get('/order/create', 'OrderController@formCreate')->name('formCreateOrder');
    Route::get('/order/detail/{order_id}', 'OrderController@formDetail');
    Route::get('/order/{order_id}', 'OrderController@formEdit');
});

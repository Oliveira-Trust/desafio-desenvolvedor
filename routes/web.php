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
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/clients/destroy-selected', 'ClientController@destroySelected')->name('clients.destroy-selected');
Route::resource('/clients', 'ClientController');

Route::post('/products/destroy-selected', 'ProductController@destroySelected')->name('products.destroy-selected');
Route::resource('/products', 'ProductController');

Route::post('/purchase-requests/destroy-selected', 'PurchaseRequestController@destroySelected')->name('purchase-requests.destroy-selected');
Route::resource('/purchase-requests', 'PurchaseRequestController');

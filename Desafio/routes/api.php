<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function() {
    Route::post('signup', 'AuthenticatorContrller@signup');
    Route::post('signin', 'AuthenticatorContrller@signin');
    Route::get('record/activate/{id}/{token}', 
               'AuthenticatorContrller@activateUpload');
    Route::middleware('auth:api')->group(function() {
        Route::post('logout', 'AuthenticatorContrller@logout');
    });
});

Route::get('client', "ClientsController@index")->name('client');
Route::post('client', "ClientsController@store")->name('client.store');
Route::put('client/{id}', "ClientsController@update")->name('client.update');
Route::delete('client/{id}', "ClientsController@destroy")->name('client.destroy');

Route::get('transaction', "TransactionsController@index")->name('transaction');
Route::post('transaction', "TransactionsController@store")->name('transaction.store');
Route::put('transaction/{id}', "TransactionsController@update")->name('transaction.update');
Route::delete('transaction/{id}', "TransactionsController@destroy")->name('transaction.destroy');

Route::get('iten/transaction', "ItenTransactionsController@index")->name('iten.transaction');
Route::post('iten/transaction/store', "ItenTransactionsController@store")->name('iten.transaction.store');
Route::get('iten/transaction/edit/{id}', "ItenTransactionsController@edit")->name('iten.transaction.edit');
Route::put('iten/transaction/update/{id}', "ItenTransactionsController@update")->name('iten.transaction.update');
Route::delete('iten/transaction/destroy/{id}', "ItenTransactionsController@destroy")->name('iten.transaction.destroy');

Route::get('product', "ProductsController@index")->name('product');
Route::post('product', "ProductsController@store")->name('product.store');
Route::put('product/{id}', "ProductsController@update")->name('product.update');
Route::delete('product/{id}', "ProductsController@destroy")->name('product.destroy');


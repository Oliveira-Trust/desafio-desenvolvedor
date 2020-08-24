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
Route::post('client/store', "ClientsController@store")->name('client.store');
Route::get('client/edit/{id}', "ClientsController@edit")->name('client.edit');
Route::put('client/update/{id}', "ClientsController@update")->name('client.update');
Route::delete('client/destroy/{id}', "ClientsController@destroy")->name('client.destroy');

Route::get('transaction', "TransactionsController@index")->name('transaction');
Route::post('transaction/store', "TransactionsController@store")->name('transaction.store');
Route::get('transaction/edit/{id}', "TransactionsController@edit")->name('transaction.edit');
Route::put('transaction/update{id}', "TransactionsController@update")->name('transaction.update');
Route::delete('transaction/destroy/{id}', "TransactionsController@destroy")->name('transaction.destroy');

Route::get('iten/transaction', "ItenTransactionsController@index")->name('iten.transaction');
Route::post('iten/transaction/store', "ItenTransactionsController@store")->name('iten.transaction.store');
Route::get('iten/transaction/edit/{id}', "ItenTransactionsController@edit")->name('iten.transaction.edit');
Route::put('iten/transaction/update/{id}', "ItenTransactionsController@update")->name('iten.transaction.update');
Route::delete('iten/transaction/destroy/{id}', "ItenTransactionsController@destroy")->name('iten.transaction.destroy');

Route::get('product', "ProductsController@index")->name('product');
Route::post('product/store', "ProductsController@store")->name('product.store');
Route::get('product/edit/{id}', "ProductsController@edit")->name('product.edit');
Route::put('product/update/{id}', "ProductsController@update")->name('product.update');
Route::delete('product/destroy/{id}', "ProductsController@destroy")->name('product.destroy');


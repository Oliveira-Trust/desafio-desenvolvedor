<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('auth')->group(function() {
    Route::post('record', 'AuthenticatorContrller@record');
    Route::post('login', 'AuthenticatorContrller@login');
    Route::get('record/activate/{id}/{token}', 
               'AuthenticatorContrller@activateUpload');
    Route::middleware('auth:api')->group(function() {
        Route::post('logout', 'AuthenticatorContrller@logout');
    });
});

Route::get('client', "ClientsController@index")->name('client')->middleware('auth:api');
Route::get('client/show', "ClientsController@show")->name('client.show')->middleware('auth:api');
Route::get('client/create', "ClientsController@create")->name('client.create')->middleware('auth:api');
Route::post('client/store', "ClientsController@store")->name('client.store')->middleware('auth:api');
Route::get('client/edit', "ClientsController@edit")->name('client.edit')->middleware('auth:api');
Route::put('client/update', "ClientsController@update")->name('client.update')->middleware('auth:api');
Route::delete('client/destroy', "ClientsController@destroy")->name('client.destroy')->middleware('auth:api');

Route::get('transaction', "TransactionsController@index")->name('transaction');
Route::get('transaction/show', "TransactionsController@show")->name('transaction.show');
Route::get('transaction/create', "TransactionsController@create")->name('transaction.create');
Route::post('transaction/store', "TransactionsController@store")->name('transaction.store');
Route::get('transaction/edit', "TransactionsController@edit")->name('transaction.edit');
Route::put('transaction/update', "TransactionsController@update")->name('transaction.update');
Route::delete('transaction/destroy', "TransactionsController@destroy")->name('transaction.destroy');

Route::get('iten/transaction', "ItenTransactionsController@index")->name('iten.transaction');
Route::get('iten/transaction/show', "ItenTransactionsController@show")->name('iten.transaction.show');
Route::get('iten/transaction/create', "ItenTransactionsController@create")->name('iten.transaction.create');
Route::post('iten/transaction/store', "ItenTransactionsController@store")->name('iten.transaction.store');
Route::get('iten/transaction/edit', "ItenTransactionsController@edit")->name('iten.transaction.edit');
Route::put('iten/transaction/update', "ItenTransactionsController@update")->name('iten.transaction.update');
Route::delete('iten/transaction/destroy', "ItenTransactionsController@destroy")->name('iten.transaction.destroy');

Route::get('product', "ProductsController@index")->name('product');
Route::get('product/show', "ProductsController@show")->name('product.show');
Route::get('product/create', "ProductsController@create")->name('product.create');
Route::post('product/store', "ProductsController@store")->name('product.store');
Route::get('product/edit', "ProductsController@edit")->name('product.edit');
Route::put('product/update', "ProductsController@update")->name('product.update');
Route::delete('product/destroy', "ProductsController@destroy")->name('product.destroy');


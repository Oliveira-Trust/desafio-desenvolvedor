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

Route::get('client', "ClientsController@index")->name('client')->middleware('auth:api');
Route::post('client/store', "ClientsController@store")->name('client.store')->middleware('auth:api');
Route::get('client/edit/{id}', "ClientsController@edit")->name('client.edit')->middleware('auth:api');
Route::put('client/update/{id}', "ClientsController@update")->name('client.update')->middleware('auth:api');
Route::delete('client/destroy/{id}', "ClientsController@destroy")->name('client.destroy')->middleware('auth:api');

Route::get('transaction', "TransactionsController@index")->name('transaction')->middleware('auth:api');
Route::post('transaction/store', "TransactionsController@store")->name('transaction.store')->middleware('auth:api');
Route::get('transaction/edit/{id}', "TransactionsController@edit")->name('transaction.edit')->middleware('auth:api');
Route::put('transaction/update{id}', "TransactionsController@update")->name('transaction.update')->middleware('auth:api');
Route::delete('transaction/destroy/{id}', "TransactionsController@destroy")->name('transaction.destroy')->middleware('auth:api');

Route::get('iten/transaction', "ItenTransactionsController@index")->name('iten.transaction')->middleware('auth:api');
Route::post('iten/transaction/store', "ItenTransactionsController@store")->name('iten.transaction.store')->middleware('auth:api');
Route::get('iten/transaction/edit/{id}', "ItenTransactionsController@edit")->name('iten.transaction.edit')->middleware('auth:api');
Route::put('iten/transaction/update/{id}', "ItenTransactionsController@update")->name('iten.transaction.update')->middleware('auth:api');
Route::delete('iten/transaction/destroy/{id}', "ItenTransactionsController@destroy")->name('iten.transaction.destroy')->middleware('auth:api');

Route::get('product', "ProductsController@index")->name('product')->middleware('auth:api');
Route::post('product/store', "ProductsController@store")->name('product.store')->middleware('auth:api');
Route::get('product/edit/{id}', "ProductsController@edit")->name('product.edit')->middleware('auth:api');
Route::put('product/update/{id}', "ProductsController@update")->name('product.update')->middleware('auth:api');
Route::delete('product/destroy/{id}', "ProductsController@destroy")->name('product.destroy')->middleware('auth:api');


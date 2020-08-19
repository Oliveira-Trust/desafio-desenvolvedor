<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('client', "ClientsController@index")->name('client');
Route::get('client/show', "ClientsController@show")->name('client.show');
Route::get('client/create', "ClientsController@create")->name('client.create');
Route::get('client/store', "ClientsController@store")->name('client.store');
Route::get('client/edit', "ClientsController@edit")->name('client.edit');
Route::get('client/update', "ClientsController@update")->name('client.update');
Route::get('client/destroy', "ClientsController@destroy")->name('client.destroy');

Route::get('transaction', "TransactionsController@index")->name('transaction');
Route::get('transaction/show', "TransactionsController@show")->name('transaction.show');
Route::get('transaction/create', "TransactionsController@create")->name('transaction.create');
Route::get('transaction/store', "TransactionsController@store")->name('transaction.store');
Route::get('transaction/edit', "TransactionsController@edit")->name('transaction.edit');
Route::get('transaction/update', "TransactionsController@update")->name('transaction.update');
Route::get('transaction/destroy', "TransactionsController@destroy")->name('transaction.destroy');

Route::get('iten/transaction', "ItenTransactionsController@index")->name('iten.transaction');
Route::get('iten/transaction/show', "ItenTransactionsController@show")->name('iten.transaction.show');
Route::get('iten/transaction/create', "ItenTransactionsController@create")->name('iten.transaction.create');
Route::get('iten/transaction/store', "ItenTransactionsController@store")->name('iten.transaction.store');
Route::get('iten/transaction/edit', "ItenTransactionsController@edit")->name('iten.transaction.edit');
Route::get('iten/transaction/update', "ItenTransactionsController@update")->name('iten.transaction.update');
Route::get('iten/transaction/destroy', "ItenTransactionsController@destroy")->name('iten.transaction.destroy');

Route::get('product', "ProductsController@index")->name('product');
Route::get('product/show', "ProductsController@show")->name('product.show');
Route::get('product/create', "ProductsController@create")->name('product.create');
Route::get('product/store', "ProductsController@store")->name('product.store');
Route::get('product/edit', "ProductsController@edit")->name('product.edit');
Route::get('product/update', "ProductsController@update")->name('product.update');
Route::get('product/destroy', "ProductsController@destroy")->name('product.destroy');
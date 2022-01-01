<?php
use App\Core\Route as Route;

Route::get('/moedas', "HomeController@index");
Route::get('/moeda/{code}/{codein}','HomeController@getCurrency');

Route::get('/payments', "PaymentController@index");
Route::post('/payment/save', "PaymentController@store");

Route::get('/transactions/{userid}', 'TransactionController@index');
Route::post('/conversion', 'TransactionController@conversion');

Route::get('/taxtransaction', 'TaxTransactionController@index');
Route::post('/taxtransaction', 'TaxTransactionController@update');


Route::get('/users', "UserController@index");

Route::get('/users/{userid}', "UserController@getOne");

Route::put('/users/{userid}', "UserController@update");
Route::delete('/users/{userid}', "UserController@destroy");

Route::post('/singup', 'UserController@store');
Route::post('/singin', 'UserController@login');

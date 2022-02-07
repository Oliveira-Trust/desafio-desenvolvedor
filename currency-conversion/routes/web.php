<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'CurrencyExchangeController@webIndex')->name('dashboard');
Route::get('/dashboard', 'CurrencyExchangeController@webIndex')->name('dashboard');

//currency-exchange
Route::get('/currency-exchange', 'CurrencyExchangeController@webIndex')->name('currency.exchange.index');
Route::post('/currency-exchange', 'CurrencyExchangeController@store')->name('currency.exchange.store');
Route::get('/currency-exchange/{currencyExchange}', 'CurrencyExchangeController@show')->name('currency.exchange.show');
Route::delete('/currency-exchange/{currencyExchange}', 'CurrencyExchangeController@destroy')->name('currency.exchange.destroy');

//Configurations
Route::get('/configurations', 'ConfigurationController@index')->name('configuration.index');
Route::post('/configurations-update', 'ConfigurationController@update')->name('configuration.update');

//Custom Auth
Route::get('login', 'CustomAuthController@index')->name('login');
Route::post('custom-login', 'CustomAuthController@customLogin')->name('login.custom');
Route::get('signout', 'CustomAuthController@signOut')->name('signout');

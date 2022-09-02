<?php

use Illuminate\Support\Facades\Route;

Route::get('/async', '\App\Http\Controllers\ExchangeController@asyncContation');
Route::get('/types', '\App\Http\Controllers\TypesController@index');
Route::get('/', '\App\Http\Controllers\ExchangeController@index');
Route::post('/', '\App\Http\Controllers\NotificationController@index');

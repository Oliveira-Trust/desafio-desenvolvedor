<?php

use Illuminate\Support\Facades\Route;

Route::get('/types', '\App\Http\Controllers\QuotationController@types');
Route::get('/{source}/{target}', '\App\Http\Controllers\QuotationController@bid');

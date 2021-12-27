<?php

use CurrencyConverter\Application\Http\Controllers\Home as HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group([
    'middleware' => ['auth'],
    'prefix' => ''
], function ($route) {
    Route::match(['get', 'post'],'/home', [HomeController::class, 'index'])->name('home');
    Route::get('/history', [HomeController::class, 'history'])->name('history');
});

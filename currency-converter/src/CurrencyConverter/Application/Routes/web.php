<?php

use Illuminate\Support\Facades\Route;
use CurrencyConverter\Application\Http\Controllers\Home as HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'home'
], function ($route) {
    Route::match(['get', 'post'],'/', [HomeController::class, 'index'])->name('home');
});

<?php

use Illuminate\Support\Facades\Route;
use CurrencyConverter\Application\Http\Controllers\Home as HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::view('home','home')->middleware('auth');

Route::group([
    'middleware' => ['auth'],
    'prefix' => 'home'
], function ($route) {
    Route::get('/', [HomeController::class, 'index'])->name('home');
});

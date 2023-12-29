<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Coin\app\Http\Controllers\CoinController;
use Modules\Coin\app\Http\Controllers\LastController;
use Modules\Coin\app\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('/', CoinController::class)->names('home');
    Route::post('/save', [LastController::class, 'index']);
    Route::get('/success', [LastController::class, 'success']);
});


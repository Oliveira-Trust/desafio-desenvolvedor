<?php

use App\Http\Controllers\BuyCurrencyController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('currency-converter')->group(function() {
    Route::controller(BuyCurrencyController::class)->group(function () {
        Route::get('/', 'index')->name('currency-converter');
        Route::post('/buy', 'buy')->name('api.currency-converter.buy');
    });    
});
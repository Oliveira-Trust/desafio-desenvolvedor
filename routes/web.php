<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;

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

Route::get('/', [CurrencyController::class, 'index'])->name('currency.index');
Route::post('currency/convert', [CurrencyController::class, 'convert'])->name('currency.calculate-conversion');

Route::get('teste', function() {
    dd(app(\App\Services\CurrencyService::class)->getAvaliableCurrencies('USD'));
});

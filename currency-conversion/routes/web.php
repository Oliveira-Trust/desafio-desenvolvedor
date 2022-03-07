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

Route::get('/', function () {
    return redirect()->route('currency.index');
});

Route::prefix('currency')->group(function () {
    Route::get('conversion', [CurrencyController::class, 'index'])->name('currency.index');
    Route::post('conversion', [CurrencyController::class, 'store'])->name('currency.store');
});
<?php

use App\Http\Controllers\BuyCurrencyController;
use App\Http\Controllers\PurchaseController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/purchases', [PurchaseController::class, 'index'])
->middleware(['auth'])->name('purchases');

Route::prefix('currency-converter')->group(function() {
    Route::controller(BuyCurrencyController::class)->group(function () {
        Route::get('/', 'index')->name('currency-converter');
        Route::post('/buy', 'buy')->name('currency-converter.buy');
    });    
});

require __DIR__.'/auth.php';

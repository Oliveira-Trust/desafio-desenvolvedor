<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\PriceQuoteController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ConversionRatesController;
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
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('login');
    })->name('dashboard');

    Route::group(['middleware' => ['can:admin']], function () {
        Route::get('conversion-rates', [ConversionRatesController::class, 'index'])->name('conversion-rates');
        
        Route::get('payment-methods/{payment_method}/edit', [PaymentMethodController::class, 'show'])->name('payment-methods-edit');
        Route::get('conversion-rates/{conversion_rate}/edit', [ConversionRatesController::class, 'show'])->name('conversion-rates-edit');
        Route::get('users', [UsersController::class, 'index'])->name('users');

        Route::put('payment-methods/{payment_method}', [PaymentMethodController::class, 'update'])->name('payment-methods-update'); 
        Route::put('conversion-rates/{conversion_rate}', [ConversionRatesController::class, 'update'])->name('conversion-rates-update'); 
               
    });
       
    Route::get('price-quote', [PriceQuoteController::class, 'create'])->name('price-quote');
    Route::get('price-quote/{price_quote}', [PriceQuoteController::class, 'show'])->name('price-quote-show');
    Route::get('history', [PriceQuoteController::class, 'index'])->name('history');
    Route::get('payment-methods', [PaymentMethodController::class, 'index'])->name('payment-methods');

    Route::post('price-quote', [PriceQuoteController::class, 'store']);
    Route::post('send-email/{price_quote}', [PriceQuoteController::class, 'sendPriceQuoteEmail'])->name('send-email');    
});

require __DIR__.'/auth.php';

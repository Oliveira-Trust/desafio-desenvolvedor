<?php

use App\Http\Controllers\ConversionFeeController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\PaymentTypeController;
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

Route::middleware(['auth'])->group(function(){

    Route::controller(PaymentTypeController::class)->group(function() {
        Route::get('/payment-types', 'index')->name('payment-types');
        Route::get('/get-payment-types', 'getPaymentTypes')->name('get-payment-types');
        Route::patch('/save-payment-type/{id}', 'savePaymentType')->name('save-payment-type');
    });

    Route::controller(ConversionFeeController::class)->group(function() {
        Route::get('/conversion-fee', 'index')->name('conversion-fee');
        Route::get('/get-conversion-fees', 'getConversionFees')->name('get-conversion-fee');
        Route::patch('/update-conversion-fee/{id}', 'updateConversionFee')->name('update-conversion-fee');
        Route::post('/create-conversion-fee', 'createConversionFee')->name('create-conversion-fee');
    });

    Route::controller(CurrencyController::class)->group(function(){
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get('/get-currencies-purchases', 'getCurrenciesPurchases')->name('get-currencies-purchases');
        Route::post('/buy-currency', 'buyCurrency')->name('buy-currency');
        Route::post('/get-converted-currency', 'getConvertedCurrency')->name('get-converted-currency');
    });

});



require __DIR__.'/auth.php';

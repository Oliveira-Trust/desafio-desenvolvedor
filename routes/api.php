<?php

use App\Http\Controllers\ExchangeFeeController;
use App\Http\Controllers\PaymentMethodsFeeController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('currencies', [QuoteController::class, 'currencies']);
    Route::get('quotes', [QuoteController::class, 'index']);
    Route::post('quotes', [QuoteController::class, 'store']);
    Route::get('payment-methods-fee', [PaymentMethodsFeeController::class, 'index']);
    Route::put('payment-methods-fee', [PaymentMethodsFeeController::class, 'update']);
    Route::get('exchange-fees', [ExchangeFeeController::class, 'index']);
    Route::put('exchange-fees', [ExchangeFeeController::class, 'update']);
});



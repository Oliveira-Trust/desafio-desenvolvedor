<?php

use Modules\Exchange\Http\Controllers\ExchangeController;
use Modules\Exchange\Http\Controllers\RatesController;

Route::prefix('admin')->middleware(['auth:sanctum', 'ability:admin'])->group(function () {
    Route::prefix('rates')->group(function () {
        Route::get('/', [RatesController::class, 'index']);
        Route::post('/', [RatesController::class, 'store']);
    });
});

Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {
    Route::prefix('exchanges')->group(function () {
        Route::get('/', [ExchangeController::class, 'index']);
        Route::post('/', [ExchangeController::class, 'conversion']);
        Route::get('/payment-methods', [ExchangeController::class, 'paymentMethods']);
        Route::get('/currencies', [ExchangeController::class, 'currencies']);
    });
});

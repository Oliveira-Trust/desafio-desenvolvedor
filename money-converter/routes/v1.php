<?php

use Illuminate\Support\Facades\Route;
use App\Api\Purchase\Controllers\PurchaseController;
use App\Api\Currencies\Controllers\CurrencyController;
use App\Api\Fees\Controllers\FeesController;
use App\Api\PaymentMethod\Controllers\PaymentMethodController;

Route::middleware(['auth'])->group(function () {
    Route::resource('purchases', PurchaseController::class)->only(['index', 'store']);
    Route::resource('fees', FeesController::class)->only(['show', 'update']);
    Route::resource('payment-methods', PaymentMethodController::class)->only(['index', 'show']);
    Route::get('payment-method/{paymentMethodId}/fees', [PaymentMethodController::class, 'getFees']);
    Route::get('currencies', [CurrencyController::class, 'availables']);
});

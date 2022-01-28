<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PurchaseController,
    CurrencyController,
    TaxeController,
    PaymentTypeController,
};

Route::middleware(['auth'])->group(function () {
    Route::resource('purchase', PurchaseController::class)->only(['index', 'store']);
    Route::resource('taxe', TaxeController::class);
    Route::get('currencies', [CurrencyController::class, 'avaliables']);
    Route::get('payment-types', [PaymentTypeController::class, 'index']);
    Route::get('payment-type/{paymentId}/taxes', [PaymentTypeController::class, 'getTaxes']);
});

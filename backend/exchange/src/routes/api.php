<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'exchange'], function() {
    Route::get('', [ExchangeController::class, 'index']);

    Route::get('{exchange_id}', [ExchangeController::class, 'show']);

    Route::get('by_user_id/{user_id}', [ExchangeController::class, 'indexByUserId']);

    Route::get('by_user_id/{user_id}/{exchange_id}', [ExchangeController::class, 'showByUserId']);

    Route::post('', [ExchangeController::class, 'create']);
});

Route::get('currency', [CurrencyController::class, 'index']);

Route::group(['prefix' => 'fee'], function() {

    Route::get('', [FeeController::class, 'index']);

    Route::get('{fee_id}', [FeeController::class, 'show']);

    Route::post('', [FeeController::class, 'create']);

    Route::put('{fee_id}', [FeeController::class, 'update']);

    Route::delete('{fee_id}', [FeeController::class, 'destroy']);
});

Route::group(['prefix' => 'payment_method'], function() {

    Route::get('', [PaymentMethodController::class, 'index']);

    Route::get('{payment_method_id}', [PaymentMethodController::class, 'show']);

    Route::put('{payment_method_id}', [PaymentMethodController::class, 'update']);

});

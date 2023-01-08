<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'force_json_response'],function(){
    Route::post('login', LoginController::class);

    Route::post('signup', SignupController::class);

    Route::middleware('auth.microservice')->group(function() {

        Route::get('profile', [ProfileController::class, 'show']);

        Route::post('logout', LogoutController::class);

        Route::get('currency', [CurrencyController::class, 'index']);

        Route::group(['prefix' => 'fee'], function() {
            Route::get('', [FeeController::class, 'index']);
            Route::get('{fee_id}', [FeeController::class, 'show']);
            Route::delete('{fee_id}', [FeeController::class, 'destroy']);
            Route::put('{fee_id}', [FeeController::class, 'update']);
            Route::post('', [FeeController::class, 'create']);
        });

        Route::group(['prefix' => 'payment_method'], function() {
            Route::get('', [PaymentMethodController::class, 'index']);
            Route::get('{payment_method_id}', [PaymentMethodController::class, 'show']);
            Route::put('{payment_method_id}', [PaymentMethodController::class, 'update']);
        });

        Route::group(['prefix' => 'exchange'], function() {
            Route::get('', [ExchangeController::class, 'indexByUserId']);
            Route::get('{exchange_id}', [ExchangeController::class, 'show']);
            Route::post('', [ExchangeController::class, 'create']);
        });

    });


});



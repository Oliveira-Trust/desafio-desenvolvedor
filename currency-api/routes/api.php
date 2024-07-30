<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware(['auth:sanctum'])->get('/available-coins', [\App\Http\Controllers\CurrencyConversionController::class, 'getAvailableCoins']);
    Route::middleware(['auth:sanctum'])->get('/history', [\App\Http\Controllers\CurrencyConversionController::class, 'getHistory']);
    Route::middleware(['auth:sanctum'])->post('/convert', [\App\Http\Controllers\CurrencyConversionController::class, 'convert']);
});

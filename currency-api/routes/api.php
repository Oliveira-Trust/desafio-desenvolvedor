<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\ExchangeFeeConfigurationController;


Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::middleware(['auth:sanctum'])->get('/available-currencies', [ExchangeController::class, 'getAvailableCurrencies']);
    Route::middleware(['auth:sanctum'])->get('/history', [ExchangeController::class, 'getHistory']);
    Route::middleware(['auth:sanctum'])->post('/convert', [ExchangeController::class, 'convert']);
    Route::middleware(['auth:sanctum'])->get('/configuration', [ExchangeFeeConfigurationController::class, 'getConfig']);
    Route::middleware(['auth:sanctum'])->post('/configuration', [ExchangeFeeConfigurationController::class, 'setConfig']);
});

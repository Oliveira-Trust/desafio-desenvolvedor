<?php

use Illuminate\Support\Facades\Route;
use App\Domains\User\Presentation\Http\Controllers\UserAuthController;
use App\Domains\Upload\Presentation\Http\Controllers\UploadController;
use App\Domains\MarketData\Presentation\Http\Controllers\MarketDataController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [UserAuthController::class, 'login']);
    Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/uploads', [UploadController::class, 'store']);
    Route::get('/uploads', [UploadController::class, 'index']);
    Route::get('/market-data', [MarketDataController::class, 'index']);
});

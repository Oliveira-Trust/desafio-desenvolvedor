<?php

use Illuminate\Support\Facades\Route;
use App\Domains\User\Presentation\Http\Controllers\UserAuthController;
use App\Domains\Upload\Presentation\Http\Controllers\UploadController;
use App\Domains\MarketData\Presentation\Http\Controllers\MarketDataController;

Route::middleware('web')->prefix('auth')->group(function () {
    Route::post('/login', [UserAuthController::class, 'login'])->middleware('throttle:login');
    Route::post('/logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::middleware(['web', 'auth:sanctum'])->group(function () {
    Route::post('/uploads', [UploadController::class, 'store'])->middleware('throttle:uploads');
    Route::get('/uploads', [UploadController::class, 'index'])->middleware('throttle:uploads-index');
    Route::get('/market-data', [MarketDataController::class, 'index'])->middleware('throttle:market-data');
});

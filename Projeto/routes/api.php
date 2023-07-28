
<?php
// routes/api.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConvertCurrencyController;
use App\Http\Controllers\HistoricalQuoteController;

Route::post('/api/login', [AuthController::class, 'login']);
Route::post('/api/register', [AuthController::class, 'register']);

Route::middleware(['auth:api'])->group(function () {
    Route::post('/api/convert', [ConvertCurrencyController::class, 'convert']);

    Route::get('/api/history', [HistoricalQuoteController::class, 'showHistory']);
});

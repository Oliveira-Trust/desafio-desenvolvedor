<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InstrumentController;

Route::get('/health', function () {
    return response()->json(['status' => 'ok']);
});

 Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::prefix('v1')->group(function () {
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/upload', [InstrumentController::class, 'upload']);
        Route::get('/history', [InstrumentController::class, 'history']);
        Route::get('/search', [InstrumentController::class, 'search']);
    });
});
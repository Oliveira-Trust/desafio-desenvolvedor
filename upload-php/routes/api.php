<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InstrumentController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth.api_token');


Route::middleware('auth.api_token')->group(function () {
    Route::prefix('v1')->group(function () {
        Route::get('/uploads/history', [InstrumentController::class, 'history']);
        Route::post('/uploads', [InstrumentController::class, 'upload']);
        Route::get('/search', [InstrumentController::class, 'search']);
    });
});

Route::prefix('v1')->group(function () {
    Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
});
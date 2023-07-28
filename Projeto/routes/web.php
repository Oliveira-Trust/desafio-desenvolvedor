
<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ConvertCurrencyController;
use App\Http\Controllers\HistoricalQuoteController;
use App\Http\Controllers\EmailController;

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ConvertCurrencyController::class, 'showConversionForm'])->name('home');
    Route::post('/convert', [ConvertCurrencyController::class, 'convert']);

    Route::get('/history', [HistoricalQuoteController::class, 'showHistory']);

    Route::post('/email', [EmailController::class, 'send']);
});

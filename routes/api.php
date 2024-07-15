<?php

declare(strict_types=1);

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EconomyQuotationsController;
use App\Http\Controllers\PaymentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
Route::get('/login/verify', [LoginController::class, 'verify'])->name('auth.verify');

Route::middleware('jwt.auth')->group(function () {
    Route::get('/translations', [EconomyQuotationsController::class, 'translations'])->name('economy.trans');
    Route::get('/combinations', [EconomyQuotationsController::class, 'combinations'])->name('economy.comb');
    Route::post('/conversion', [EconomyQuotationsController::class, 'conversion'])->name('economy.conv');
    Route::get('/payments', [PaymentsController::class, 'index'])->name('economy.payment');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.payment');
});

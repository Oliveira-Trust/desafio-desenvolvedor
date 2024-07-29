<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas protegidas por autenticação
Route::middleware(['auth'])->group(function () {
    Route::get('/currency', [CurrencyController::class, 'index'])->name('currency.index');
    Route::post('/convert', [CurrencyController::class, 'convert'])->name('convert');
    Route::get('/history', [CurrencyController::class, 'history'])->name('currency.history');
});

require __DIR__.'/auth.php';

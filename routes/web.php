<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Awesome\{AvaliableController, BuyController, TaxeController};


Route::middleware(['auth:sanctum', 'verified', 'verified.admin'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/taxas', [TaxeController::class, 'index'])->name('taxes');
    Route::post('/taxas', [TaxeController::class, 'update'])->name('update-taxe');
});

Route::middleware(['auth:sanctum', 'verified',])->group(function () {
    Route::get('/', [AvaliableController::class, 'index'])->name('index');
    Route::post('/buy', [BuyController::class, 'buy'])->name('buy');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Awesome\{AvaliableController, BuyController, TaxeController};

Route::get('/', [AvaliableController::class, 'index']);
Route::post('/buy', [BuyController::class, 'buy'])->name('buy');



Route::middleware(['auth:sanctum', 'verified'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/taxas', [TaxeController::class, 'index'])->name('taxes');
    Route::post('/taxas', [TaxeController::class, 'update'])->name('update-taxe');
});

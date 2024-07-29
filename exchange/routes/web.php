<?php

use App\Http\Controllers\ExchangeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('exchange');
    }
    return redirect()->route('login');
});

Route::get('/exchange', [ExchangeController::class, 'index'])->middleware(['auth', 'verified'])->name('exchange');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/exchange', [ExchangeController::class, 'store'])->name('exchange.store');
});

require __DIR__.'/auth.php';

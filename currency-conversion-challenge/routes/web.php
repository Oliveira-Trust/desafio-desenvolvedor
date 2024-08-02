<?php

use App\Http\Controllers\CurrencyConverterController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CurrencyConverterController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/convert', [CurrencyConverterController::class, 'convert'])->name('convert');
    Route::get('/conversion/{id}', [CurrencyConverterController::class, 'show'])->name('conversion.show');
    Route::delete('/conversion/{id}', [CurrencyConverterController::class, 'delete'])->name('conversion.delete');
    Route::get('sendEmail/{id}', [EmailController::class, 'sendEmail'])->name('sendEmail'); ;

    Route::get('/conversion', function () {
        return view('conversion.conversion');
    })->name('conversion.conversion');
});

require __DIR__.'/auth.php';

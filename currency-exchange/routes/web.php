<?php

use App\Http\Controllers\ConversionController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'fees'], function () {
    Route::get('/', [FeeController::class, 'get'])->name('fees');
    Route::get('/edit/{id}', [FeeController::class, 'edit'])->name('fees.edit');
    Route::put('/update/{id}', [FeeController::class, 'update'])->name('fees.update');
    Route::delete('/delete/{fee}', [FeeController::class, 'destroy'])->name('fees.destroy');
});


Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');

Route::group(['prefix' => 'currency-exchanges'], function () {
    Route::get('', [CurrencyController::class, 'index'])->name('currency-exchanges');
    Route::post('/create', [CurrencyController::class, 'create'])->name('currency-exchanges.create');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';

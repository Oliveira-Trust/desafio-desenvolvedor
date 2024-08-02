<?php

use App\Http\Controllers\ConverterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConverterController::class, 'convert'])->name('home');
Route::post('/', [ConverterController::class, 'convert'])->name('converter');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', fn () => view('app.dashboard'))->name('dashboard');

    Route::get('/converter', [ConverterController::class, 'appConvert'])->name('app.converter');
    Route::post('/converter', [ConverterController::class, 'appConvert'])->name('app.converter');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/conversion-rate/update', [SettingController::class, 'updateConversionRate'])->name('settings.updateConversionRate');
    Route::post('/settings/payment-method/update', [SettingController::class, 'updatePaymentMethod'])->name('settings.updatePaymentMethod');
    Route::post('/settings/payment-method', [SettingController::class, 'createPaymentMethod'])->name('settings.createPaymentMethod');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

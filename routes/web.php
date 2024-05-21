<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FeeRuleController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect("/dashboard");
});

Route::get('/dashboard', DashboardController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/quotes', QuoteController::class)->except(['edit', 'update', 'destroy']);
    Route::post('/quotes/calc', [QuoteController::class, 'calc'])->name('quotes.calc');
    Route::get('/settings', [SettingsController::class, 'edit'])->name('settings.edit');
    Route::put('/feeRules', [FeeRuleController::class, 'updateFeeRule'])->name('feeRules.update');
    Route::put('/payment-methods', [PaymentMethodController::class, 'updatePaymentMethod'])->name('paymentMethods.update');
});

require __DIR__ . '/auth.php';

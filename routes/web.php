<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\TaxSettingsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/tax-settings', TaxSettingsController::class)->only(['index', 'edit', 'update']);
    Route::post('/quote/quotation', [QuoteController::class, 'quotation'])->name('quote.quotation');
    Route::resource('/quote', QuoteController::class);
});

require __DIR__.'/auth.php';

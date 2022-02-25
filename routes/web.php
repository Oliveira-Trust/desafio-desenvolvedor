<?php

use App\Http\Controllers\CurrencyQuoteController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('', [CurrencyQuoteController::class, 'index'])->name('currencyQuote.index');
    Route::post('', [CurrencyQuoteController::class, 'toConvert'])->name('currencyQuote.toConvert');
});

require __DIR__ . '/auth.php';

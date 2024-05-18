<?php

use App\Http\Controllers\CurrencyConversionController;
use Illuminate\Support\Facades\Route;

Route::post('currency-conversion', [CurrencyConversionController::class, 'convert'])->name('currency-conversion');

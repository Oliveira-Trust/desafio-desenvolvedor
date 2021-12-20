<?php

use App\Http\Controllers\CurrencyQuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/historico-de-cotacoes', [CurrencyQuoteController::class, 'index'])->name('currency-quotes');
Route::middleware(['auth:sanctum', 'verified'])->post('/historico-de-cotacoes', [CurrencyQuoteController::class, 'store'])->name('currency-quotes');

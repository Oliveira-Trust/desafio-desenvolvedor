<?php

use App\Http\Controllers\Panel\CurrencyExchangeHistoricController;
use App\Http\Controllers\Panel\CurrencyExchangeSettingsController;
use App\Http\Controllers\Panel\CurrencyExchangeController;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::group(['middleware' => 'verified'], function () {
    Route::redirect('/', 'currency-exchange');

    Route::group(['prefix' => 'currency-exchange'], function () {
        Route::get('/', [CurrencyExchangeController::class, 'index'])->name('index');
//        Route::post('/', [CurrencyExchangeController::class, 'index'])->name('index');
        Route::post('/', [CurrencyExchangeController::class, 'currencyExchange'])->name('currencyExchange');

        Route::get('/historic', CurrencyExchangeHistoricController::class)->name('currencyExchangeHistoric');
        Route::get('/settings', [CurrencyExchangeSettingsController::class, 'show'])->name('currencyExchangeSettings');
        Route::post('/settings', [CurrencyExchangeSettingsController::class, 'save'])->name('saveCurrencyExchangeSettings');
    });
});

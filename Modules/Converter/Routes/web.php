<?php

use Illuminate\Support\Facades\Route;
use Modules\Converter\Http\Controllers\ConverterController;

Route::prefix('converter')->name('converter.')->middleware('auth')->group(function () {
    Route::get('/', [ConverterController::class, 'index'])->name('index');
    Route::post('/make', [ConverterController::class, 'make'])->name('make');
    Route::get('/conversion-result/{conversionHistoryResultId}', [ConverterController::class, 'result'])->name('result');
});

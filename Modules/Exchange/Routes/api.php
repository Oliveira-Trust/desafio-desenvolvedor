<?php

use Modules\Exchange\Http\Controllers\RatesController;

Route::prefix('admin')->middleware(['auth:sanctum', 'ability:admin'])->group(function () {
    Route::prefix('rates')->group(function () {
        Route::get('/', [RatesController::class, 'index']);
        Route::post('/', [RatesController::class, 'store']);
    });
});

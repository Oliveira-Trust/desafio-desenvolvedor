<?php

use AwesomeApi\Controllers\AwesomeApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(function(): void {
    Route::get('/list-currencies', AwesomeApiController::class . '@listAvailableCurrencies');
});

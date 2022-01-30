<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\AweSomeApi;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get("/prices", [PriceController::class, 'index'])->name('prices');

Route::get("/prices/getall", [PriceController::class, 'getAll']);

Route::post("/prices", [PriceController::class, 'create']);

Route::get("/settings", [PriceController::class, 'index'])->name('settings');

Route::get("/awesomeapi/conversion-currency/{from}/{to}", [AweSomeApi::class, 'conversionCurrency']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AweSomeApi;

//Routes General

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

//Routes Prices

Route::get("/prices", [PriceController::class, 'index'])->name('prices');

Route::get("/prices/getall", [PriceController::class, 'getAll']);

Route::post("/prices", [PriceController::class, 'create']);

//Routes Settings

Route::get("/settings", [SettingController::class, 'index'])->name("settings");

Route::post("/settings", [SettingController::class, 'store']);

Route::get("/settings/getall", [SettingController::class, 'getAll']);

//Routes AweSomeApi

Route::get("/awesomeapi/conversion-currency/{from}/{to}", [AweSomeApi::class, 'conversionCurrency']);
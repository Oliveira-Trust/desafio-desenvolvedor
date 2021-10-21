<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Awesome\{AvaliableController, BuyController, TaxeController};
use App\Mail\Email;
use Illuminate\Support\Facades\Mail;

Route::middleware(['auth:sanctum', 'verified', 'verified.admin'])->prefix('dashboard')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/taxas', [TaxeController::class, 'index'])->name('taxes');
    Route::post('/taxas', [TaxeController::class, 'update'])->name('update-taxe');
});

Route::middleware(['auth:sanctum', 'verified',])->group(function () {
    Route::get('/', [AvaliableController::class, 'index'])->name('index');
    Route::post('/buy', [BuyController::class, 'buy'])->name('buy');
    Route::get('/historic', [BuyController::class, 'historic'])->name('historic');

});
/*
Route::get('/email', function() {

    Mail::to('diegooliveiratrust@gmail.com')->send(new Email);

    return new Email();
});
 */

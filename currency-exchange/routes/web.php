<?php

use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyExchangeController;

Route::get('/currency-exchange', [CurrencyExchangeController::class, 'index']);


Route::get('/', function () {
    return view('welcome');
});

Route::get('test', function () {
    return "test";
});

Route::get('/fetch-data', [ApiController::class, 'getData'])->name('fetch-data');
Route::post('/exchange', [ApiController::class, 'exchangeCurrency'])->name('exchange');

Route::get('test', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'fee'], function () {
    Route::get('/get', [FeeController::class, 'get'])->name('fee');
    Route::get('/edit/{id}', [FeeController::class, 'edit'])->name('fee.edit');
    Route::put('/update', [FeeController::class, 'update'])->name('fee.update');
});


Route::get('/currency-exchanges', [CurrencyController::class, 'index']);

Route::get('/currency-exchanges-drop-down', [CurrencyController::class, 'index_drop_down']);



Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::post('/users/{id}/update', [UserController::class, 'update'])->name('users.update');

Route::get('/currency-convert/{combination}', [CurrencyController::class, 'convert'])->name('currency.convert');


require __DIR__.'/auth.php';

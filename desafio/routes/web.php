<?php

use App\Http\Controllers\ConverterCurrencyController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ConverterCurrencyController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('moeda')->middleware(['auth'])->group(function () {
    Route::get('/formulario', [ConverterCurrencyController::class, 'showForm'])
        ->name('moeda.formulario');

    Route::post('/converter', [ConverterCurrencyController::class, 'storeConversion'])
        ->name('moeda.converter');
});

require __DIR__.'/auth.php';

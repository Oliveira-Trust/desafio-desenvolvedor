<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\UserConversionsController;
use App\Http\Controllers\UserConversionResponsesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/conversion', function () {
    return Inertia::render('ConversionCurrency');
})->name('conversion');

Route::post('/conversion', [UserConversionsController::class, 'recordCreationAndCurrencyConversion'])
    ->name('conversion.recordCreationAndCurrencyConversion');

Route::middleware(['auth:sanctum', 'verified'])->get('/history', function () {
    return Inertia::render('HistoryUserConversions');
})->name('history');

Route::get('/history', [UserConversionResponsesController::class, 'show'])
    ->name('history.show');




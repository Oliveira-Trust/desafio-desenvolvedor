<?php

use App\Http\Controllers\ConversionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendQuotationMail;
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/conversions/create');

Route::get('/conversions/create', [ConversionController::class, 'create'])->name('conversions.create');
Route::post('/conversions', [ConversionController::class, 'store'])->name('conversions.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/taxes/edit', [TaxController::class, 'edit'])->name('taxes.edit');
    Route::patch('/taxes', [TaxController::class, 'update'])->name('taxes.update');
    Route::post('/send-quotation-mail/{conversionId}', SendQuotationMail::class)->name('send-quotation-mail');
});

require __DIR__ . '/auth.php';

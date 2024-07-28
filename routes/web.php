<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuotationController;
use App\Http\Middleware\AdminRedirect;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware([AdminRedirect::class])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('quotation')->group(function () {
       Route::get('/', [QuotationController::class, 'index'])->name('quotation.index');
       Route::post('/', [QuotationController::class, 'store'])->name('quotation.store');
    });

    Route::prefix('admin')->group(function () {
       Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
       Route::patch('/payment-tax', [AdminController::class, 'paymentTax'])->name('admin.payment.tax');
       Route::put('/conversion-tax', [AdminController::class, 'conversionTax'])->name('admin.conversion.tax');
    });
});

require __DIR__.'/auth.php';

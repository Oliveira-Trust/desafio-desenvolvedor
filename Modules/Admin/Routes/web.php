<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;

Route::prefix('admin')->name('admin.')->middleware('admin')->group(function() {
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::patch('/update-payment-methods-fees', [AdminController::class, 'updatePaymentMethodsFees'])->name('updatePaymentMethodsFees');
    Route::patch('/update-conversion-fees', [AdminController::class, 'updateConversionFees'])->name('updateConversionFees');
});

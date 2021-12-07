<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ConversionController;
use App\Http\Controllers\TaxController;

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

Route::get('/', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::group(['prefix' => 'tax'], function () {
        Route::get('/get', [TaxController::class, 'get'])->name('tax');
        Route::get('/edit/{id}', [TaxController::class, 'edit'])->name('tax.edit');
        Route::put('/update', [TaxController::class, 'update'])->name('tax.update');
    });
    
    Route::group(['prefix' => 'currency-conversion'], function () {
        Route::get('/get', [ConversionController::class, 'get'])->name('currency.conversion');
        Route::post('/create', [ConversionController::class, 'create'])->name('currency.conversion.create');
    });
});

require __DIR__.'/auth.php';

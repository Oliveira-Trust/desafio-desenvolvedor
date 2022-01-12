<?php

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

Route::get('/', function () {
    return redirect()->route('price.create');
});

Auth::routes();


/*
|--------------------------------------------------------------------------
| COTAÇÕES
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth'] ], function() {
    Route::prefix('cotacao')->group(function () {
        Route::name('price.')->group(function () {
            Route::get('/criar', [App\Http\Controllers\Price\PriceController::class, 'create'])->name('create');
            Route::post('/criar', [App\Http\Controllers\Price\PriceController::class, 'store'])->name('store');
        });
    });
});

/*
|--------------------------------------------------------------------------
| TAXAS
|--------------------------------------------------------------------------
*/
Route::group(['middleware' => ['auth', 'admin'] ], function() {
    Route::prefix('taxas')->group(function () {
        Route::name('fee.')->group(function () {
            Route::get('/todas', [App\Http\Controllers\Fee\FeeController::class, 'index'])->name('index');
            Route::get('/editar/{id}', [App\Http\Controllers\Fee\FeeController::class, 'edit'])->name('edit');
            Route::put('/editar/{id}', [App\Http\Controllers\Fee\FeeController::class, 'update'])->name('update');
        });
    });
});

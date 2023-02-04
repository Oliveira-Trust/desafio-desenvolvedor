<?php

use App\Http\Controllers\CoinConversionController;
use App\Http\Controllers\HistoryCotationController;
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
Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function () {
        return view('home');
    });


});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'conversion'], function () {
        Route::get('get-convert', [CoinConversionController::class, 'getFormConversion'])->name('form-conversion');
        Route::post('convert', [CoinConversionController::class, 'coversion'])->name('post-conversion');
    });

    Route::group(['prefix' => 'history-cotation'], function () {
        Route::get('history', [HistoryCotationController::class, 'history'])->name('history');
        Route::get('show/{id}', [HistoryCotationController::class, 'show'])->name('history-show');
    });
});

Auth::routes();



<?php

use App\Http\Controllers\ConversionController;
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
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', [ConversionController::class, "index"])->name('dashboard');
    Route::get('/history', [ConversionController::class, "historyConversion"])->name('history');
    Route::get('/feesCharged', [ConversionController::class, "feesCharged"])->name('feesCharged');
    
    Route::post('/convertMoney', [ConversionController::class, "convertMoney"]);
    Route::post('/saveFeesCharged', [ConversionController::class, "saveFeesCharged"])->name('saveFeesCharged');
    Route::get('/resetFees', [ConversionController::class, "resetFees"])->name('reset.fees');
    
});


require __DIR__.'/auth.php';

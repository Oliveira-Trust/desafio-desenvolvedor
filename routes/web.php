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

Route::middleware(['auth'])->group(function () {

    // Route::get('/', function () {
    //     return view('welcome');
    // });

    Route::get('/', [App\Http\Controllers\MoedaController::class, 'index']);

    Route::post('cadastro_moeda', [App\Http\Controllers\MoedaController::class, 'create'])->name('cadastro_moeda');
});

require __DIR__.'/auth.php';

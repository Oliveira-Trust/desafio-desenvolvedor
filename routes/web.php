<?php

use App\Http\Controllers\AcessoController;
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
    return view('acesso');
})->name('acesso');

Route::post('acesso', [AcessoController::class, 'acessar'])->name('acesso.login');

Route::prefix('sistema')->middleware(['auth', 'web'])->group(function () {
    Route::get('/principal', function () {
        return view('principal');
    })->name('principal');

    Route::get('/historico', function () {
        return view('historico');
    })->name('historico');

    Route::get('/taxas', function () {
        return view('taxa');
    })->name('taxa');
});

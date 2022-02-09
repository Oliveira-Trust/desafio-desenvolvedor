<?php

use App\Http\Controllers\ControladorCotacao;
use Illuminate\Support\Facades\Route;
require __DIR__.'/auth.php';
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
    return view('auth.login');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

    Route::get('/cotacao/{moedaDestino}',[ControladorCotacao::class,'requisicao'])->name('requisicao');
    Route::any('/calcular',[ControladorCotacao::class,'calcular'])->name('calcular');






<?php

use App\Http\Controllers\ConversorMoedaController;
use App\Http\Controllers\UsuarioController;
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

Route::view('login', 'login')->name('login');

Route::post('login', [UsuarioController::class, 'login']);
Route::get('logout', [UsuarioController::class, 'logout'])->name('logout');
Route::get('historicoCotacaoMoeda', [ConversorMoedaController::class, 'historicoCotacaoMoeda'])->name('historicoCotacaoMoeda');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('conversao');
    });

    Route::view('conversao', 'conversao')->name('conversao');   
   
});


Route::view('cadastrartaxaconversao', 'cadastrartaxaconversao')->name('cadastrartaxaconversao');
Route::view('cadastrartaxapagamento', 'cadastrartaxapagamento')->name('cadastrartaxapagamento');




<?php

use App\Http\Controllers\CompraController;
use \App\Http\Controllers\TaxaController;
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
    return view('auth/login');
});

Route::controller(TaxaController::class)->middleware(['auth'])->group(function () {
    Route::get('/painel-taxa', 'taxaPainel')->name('painel-taxa');
    Route::post('/salva-taxa-conversao', 'SalvaTaxaConversao')->name('salva-taxa-conversao');
    Route::post('/salva-taxa-pagamento', 'SalvaTaxaPagamento')->name('salva-taxa-pagamento');
});

Route::controller(CompraController::class)->middleware(['auth'])->group(function () {
    Route::get('/dashboard', 'montaTela')->name('dashboard');
    Route::post('/converter', 'converterMoeda')->name('converter');
});

require __DIR__.'/auth.php';

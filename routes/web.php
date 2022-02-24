<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoedasController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\FormasPagamentoController;
use App\Models\Historico;

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
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('conversao')->group(function () {
    Route::get('/', [HistoricoController::class, 'index'])->name('conversoes');
    Route::get('novo', [HistoricoController::class, 'create'])->name('conversao.novo');
    Route::post('simular', [HistoricoController::class, 'store'])->name('conversao.simular');
    Route::get('detalhes/{id}', [HistoricoController::class, 'show'])->name('conversao.show');
    Route::get('email/{id}', [HistoricoController::class, 'EnviarNovoEmail'])->name('conversao.mail');

    Route::prefix('moedas')->group(function () {
        Route::get('/', [MoedasController::class, 'index'])->name('moedas');
        Route::get('create', [MoedasController::class, 'create'])->name('moeda.novo');
        Route::post('store', [MoedasController::class, 'store'])->name('moeda.store');
        Route::get('edit/{id}', [MoedasController::class, 'edit'])->name('moeda.edit');
        Route::put('update/{id}', [MoedasController::class, 'update'])->name('moeda.update');
        Route::delete('delete/{id}', [MoedasController::class, 'destroy'])->name('moeda.destroy');
    });

    Route::prefix('formas-pagamentos')->group(function () {
        Route::get('/', [FormasPagamentoController::class, 'index'])->name('formas.pags');
        Route::get('create', [FormasPagamentoController::class, 'create'])->name('formas.pag.novo');
        Route::post('store', [FormasPagamentoController::class, 'store'])->name('formas.pag.store');
        Route::get('edit/{id}', [FormasPagamentoController::class, 'edit'])->name('formas.pag.edit');
        Route::put('update/{id}', [FormasPagamentoController::class, 'update'])->name('formas.pag.update');
        Route::delete('delete/{id}', [FormasPagamentoController::class, 'destroy'])->name('formas.pag.destroy');
    });
});

Auth::routes();

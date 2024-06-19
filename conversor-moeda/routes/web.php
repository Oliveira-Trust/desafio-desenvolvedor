<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CotacaoController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\TaxasController;



Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Usuários
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Conversor
    Route::get('/cotacao', [CotacaoController::class, 'obterCotacao']);
    Route::post('/converter-valor', [CotacaoController::class, 'converterValor'])->name('converterValor');
    
    //Histórico
    Route::get('/historico', [HistoricoController::class, 'index'])->name('historico.index');
    
    //Taxas
    Route::get('/taxas', [TaxasController::class, 'index'])->name('taxas.index');
    Route::post('/salvar-taxas-editadas', [TaxasController::class, 'salvarTaxasEditadas'])->name('salvarTaxasEditadas');

});

require __DIR__.'/auth.php';

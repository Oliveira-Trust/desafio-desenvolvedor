<?php

use App\Http\Controllers\Api\CotacaoController;
use App\Http\Controllers\Api\TaxaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::match(['get', 'post'], 'getCotacao', [CotacaoController::class, 'cotacao'])->name('cotacao.getCotacao');
Route::get('getTaxa', [TaxaController::class, 'getTaxas'])->name('taxa.buscar');
Route::post('setTaxa', [TaxaController::class, 'salvarTaxas'])->name('taxa.salvar');

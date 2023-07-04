<?php

use Modules\ConversorMoedas\Http\Controllers\ConversorMoedasController;

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

Route::prefix('painel')->group(function() {
    Route::get('/', 'PainelController@index');
    Route::get('/conversor-painel', 'PainelController@conversor')->middleware(['auth']); //rota protegida por autenticação
    Route::post('/conversor-moeda-painel', [ConversorMoedasController::class, 'index'])->middleware(['auth']); 
    Route::get('/listagem-conversao', 'PainelController@conversoesLista')->middleware(['auth']); 
    Route::get('/formas-pagamento', 'PainelController@formasPagamento')->middleware(['auth']); 
    Route::post('/modificar-taxas', 'PainelController@edit')->middleware(['auth']); 
    Route::post('/remover-taxa', 'PainelController@destroy')->middleware(['auth']); 
    Route::post('/adicionar-taxa', 'PainelController@create')->middleware(['auth']); 
});




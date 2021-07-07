<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController; 
use App\Http\Controllers\ClienteController;
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

Route::get('/produtos', [ProdutoController::class, 'index'])->name('produto_index');
Route::get('/produtos/criar', [ProdutoController::class, 'create'])->name('novo_produto');
Route::post('/produtos/criar', [ProdutoController::class, 'store'])->name('salvar_produto');
Route::get('/produtos/editar/{id}', [ProdutoController::class, 'edit'])->name('editar_produto');
Route::put('/produtos/editar/{id}', [ProdutoController::class, 'update'])->name('atualizar_produto');

Route::get('/produtos/{id}',[ProdutoController::class, 'destroy'])->name('excluir_produto');

Route::get('/clientes',[ClienteController::class, 'index'])->name('cliente_index');
Route::get('/clientes/criar',[ClienteController::class, 'create'])->name('novo_cliente');
Route::post('/clientes/criar', [ClienteController::class, 'store'])->name('salvar_cliente');
Route::get('/clientes/editar/{id}',[ClienteController::class, 'edit'])->name('editar_cliente');
Route::put('/clientes/editar/{id}',[ClienteController::class, 'update'])->name('atualizar_cliente');

Route::get('/clientes/{id}',[ClienteController::class, 'destroy'])->name('excluir_cliente');


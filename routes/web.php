<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;
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

//Route::get('/', [ProdutoController::class, 'loja']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/produtos/loja', [ProdutoController::class,'loja'])->name('produto_loja');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos', [ProdutoController::class, 'index'])->name('produto_index');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos/criar', [ProdutoController::class, 'create'])->name('novo_produto');
Route::middleware(['auth:sanctum', 'verified'])->post('/produtos/criar', [ProdutoController::class, 'store'])->name('salvar_produto');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos/editar/{id}', [ProdutoController::class, 'edit'])->name('editar_produto');
Route::middleware(['auth:sanctum', 'verified'])->put('/produtos/editar/{id}', [ProdutoController::class, 'update'])->name('atualizar_produto');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos/{id}',[ProdutoController::class, 'destroy'])->name('excluir_produto');

Route::middleware(['auth:sanctum', 'verified'])->post('/produtos/inserir-produto-carrinho', [PedidoController::class, 'inserirProdutoCarrinho'])->name('inserir_produto_carrinho');
Route::middleware(['auth:sanctum', 'verified'])->post('/produtos/checkout-pedido', [PedidoController::class, 'checkoutPedido'])->name('checkout_pedido');

Route::middleware(['auth:sanctum', 'verified'])->delete('/produtos/cancelar-pedido', [PedidoController::class, 'cancelarPedido'])->name('cancelar_pedido');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

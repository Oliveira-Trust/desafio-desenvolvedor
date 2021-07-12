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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/produtos', [ProdutoController::class, 'index'])->name('produto_index');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos/criar', [ProdutoController::class, 'create'])->name('novo_produto');
Route::middleware(['auth:sanctum', 'verified'])->post('/produtos/criar', [ProdutoController::class, 'store'])->name('salvar_produto');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos/editar/{id}', [ProdutoController::class, 'edit'])->name('editar_produto');
Route::middleware(['auth:sanctum', 'verified'])->put('/produtos/editar/{id}', [ProdutoController::class, 'update'])->name('atualizar_produto');
Route::middleware(['auth:sanctum', 'verified'])->get('/produtos/{id}',[ProdutoController::class, 'destroy'])->name('excluir_produto');


Route::middleware(['auth:sanctum', 'verified'])->get('/loja', [PedidoController::class, 'index'])->name('loja_index');
Route::middleware(['auth:sanctum', 'verified'])->post('/loja/inserir-produto-carrinho', [PedidoController::class, 'inserirProdutoCarrinho'])->name('inserir_produto_carrinho');
Route::middleware(['auth:sanctum', 'verified'])->post('/loja/alterar-quantidade-produto-carrinho', [PedidoController::class, 'alterarQuantidadeProdutoCarrinho'])->name('alterar_quantidade_produto_carrinho');
Route::middleware(['auth:sanctum', 'verified'])->delete('/loja/excluir-produto-carrinho', [PedidoController::class, 'excluirProdutoCarrinho'])->name('excluir_produto_carrinho');
Route::middleware(['auth:sanctum', 'verified'])->get('/loja/meus-pedidos', [PedidoController::class, 'meusPedidos'])->name('meus_pedidos');
Route::middleware(['auth:sanctum', 'verified'])->post('/loja/checkout-pedido', [PedidoController::class, 'checkoutPedido'])->name('checkout_pedido');
Route::middleware(['auth:sanctum', 'verified'])->delete('/loja/cancelar-pedido', [PedidoController::class, 'cancelarPedido'])->name('cancelar_pedido');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

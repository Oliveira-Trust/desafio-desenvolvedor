<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/produtos/novo', [App\Http\Controllers\ProdutosController::class, 'create'])->name('cadastrar_produto')->middleware('auth');
Route::post('/produtos/novo', [App\Http\Controllers\ProdutosController::class, 'store'])->name('registrar_produto')->middleware('auth');
Route::get('/produtos/ver/{id}', [App\Http\Controllers\ProdutosController::class, 'show'])->middleware('auth');
Route::post('/produtos/ver/{id}', [App\Http\Controllers\ProdutosController::class, 'update'])->name('alterar_produto')->middleware('auth');
Route::get('/produtos/excluir/{id}', [App\Http\Controllers\ProdutosController::class, 'delete'])->middleware('auth');
Route::post('/produtos/excluir/{id}', [App\Http\Controllers\ProdutosController::class, 'destroy'])->name('excluir_produto')->middleware('auth');
Route::get('/produtos/deletar/{id}', [App\Http\Controllers\ProdutosController::class, 'destroy'])->middleware('auth');
Route::get('/produtos/listar', [App\Http\Controllers\ProdutosController::class, 'list'])->name('listar_produtos')->middleware('auth');

Route::get('/pedidos', [App\Http\Controllers\PedidosController::class, 'list'])->name('listar_pedidos')->middleware('auth');
Route::get('/pedidos/inserir', [App\Http\Controllers\PedidosController::class, 'create'])->name('inserir_pedido')->middleware('auth');
Route::post('/pedidos/salvar', [App\Http\Controllers\PedidosController::class, 'store'])->name('salva_pedido')->middleware('auth');
Route::get('/pedidos/itens/{id}', [App\Http\Controllers\PedidosController::class, 'itens'])->name('inserir_itens_pedido')->middleware('auth');
Route::post('/pedidos/salvar_itens', [App\Http\Controllers\PedidosController::class, 'store_itens'])->name('salva_itens')->middleware('auth');
Route::get('/pedidos/deletar/{id}', [App\Http\Controllers\PedidosController::class, 'destroy'])->middleware('auth');
Route::get('/pedidos/editar/{id}', [App\Http\Controllers\PedidosController::class, 'edit'])->name('editar_pedido')->middleware('auth');
Route::post('/pedidos/update', [App\Http\Controllers\PedidosController::class, 'update'])->name('update_pedido')->middleware('auth');
Route::get('/pedidos/concluido', [App\Http\Controllers\PedidosController::class, 'concluido'])->name('pedido_concluido')->middleware('auth');


Route::get('/clientes', [App\Http\Controllers\ClientesController::class, 'list'])->name('listar_clientes')->middleware('auth');
Route::get('/clientes/inserir', [App\Http\Controllers\ClientesController::class, 'create'])->name('inserir_cliente')->middleware('auth');
Route::post('/clientes/inserir', [App\Http\Controllers\ClientesController::class, 'store'])->name('registrar_cliente')->middleware('auth');
Route::get('/clientes/deletar/{id}', [App\Http\Controllers\ClientesController::class, 'destroy'])->middleware('auth');
Route::get('/clientes/editar/{id}', [App\Http\Controllers\ClientesController::class, 'show'])->middleware('auth');
Route::post('/clientes/editar/{id}', [App\Http\Controllers\ClientesController::class, 'update'])->name('update_cliente')->middleware('auth');
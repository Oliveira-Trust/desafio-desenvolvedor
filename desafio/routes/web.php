<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();


Route::get('/', function () {
    return view('produtos.listar',['current' => 'produtos']);
})
    ->middleware('auth');

//Rotas de Produtos
Route::get('/produtos', [App\Http\Controllers\ProdutosController::class, 'index'])
    ->name('listar_produtos')
    ->middleware('auth');
Route::get('/produtos/cadastrar', [App\Http\Controllers\ProdutosController::class, 'create'])
    ->middleware('auth');
Route::post('/produtos/cadastrar', [App\Http\Controllers\ProdutosController::class, 'store'])
    ->name('registrar_produto')
    ->middleware('auth');
Route::get('/produtos/destroy/{id}', [App\Http\Controllers\ProdutosController::class, 'destroy'])
    ->name('deletar_produto')
    ->middleware('auth');
Route::get('/produtos/edit/{id}', [App\Http\Controllers\ProdutosController::class, 'edit'])
    ->middleware('auth');
Route::post('produtos/update', [App\Http\Controllers\ProdutosController::class, 'update'])
    ->name('editar_produto')
    ->middleware('auth');

//Rotas de Clientes
Route::get('/clientes', [App\Http\Controllers\ClientesController::class, 'index'])
    ->name('listar_clientes')
    ->middleware('auth');
Route::get('/clientes/cadastrar', [App\Http\Controllers\ClientesController::class, 'create'])
    ->middleware('auth');
Route::post('/clientes/cadastrar', [App\Http\Controllers\ClientesController::class, 'store'])
    ->name('registrar_cliente')
    ->middleware('auth');
Route::get('/clientes/destroy/{id}', [App\Http\Controllers\ClientesController::class, 'destroy'])
    ->name('deletar_cliente')
    ->middleware('auth');
Route::get('/clientes/edit/{id}', [App\Http\Controllers\ClientesController::class, 'edit'])
    ->middleware('auth');
Route::post('clientes/update', [App\Http\Controllers\ClientesController::class, 'update'])
    ->name('editar_cliente')
    ->middleware('auth');


//Rotas de Compras
Route::get('/compras', [App\Http\Controllers\ComprasController::class, 'index'])
->name('listar_compras')
->middleware('auth');
Route::get('/compras/cadastrar', [App\Http\Controllers\ComprasController::class, 'create'])
->middleware('auth');
Route::post('/compras/cadastrar', [App\Http\Controllers\ComprasController::class, 'store'])
->name('registrar_compra')
->middleware('auth');
Route::get('/compras/destroy/{id}', [App\Http\Controllers\ComprasController::class, 'destroy'])
->name('deletar_compra')
->middleware('auth');
Route::get('/compras/edit/{id}', [App\Http\Controllers\ComprasController::class, 'edit'])
->middleware('auth');
Route::post('compras/update', [App\Http\Controllers\ComprasController::class, 'update'])
->name('editar_compra')
->middleware('auth');
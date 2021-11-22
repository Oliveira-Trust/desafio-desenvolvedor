<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\{
    UserController,
    CotacaoController,
    FormaPagamentoController,
    LoginController,
};

Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('logar', [LoginController::class, 'logar'])->name('logar');
Route::get('show', [UserController::class, 'show'])->name('show.user');
Route::post('create', [UserController::class, 'create'])->name('create.user');
Route::post('logout', [LoginController::class, 'logout'])->name('logout.user');

Route::middleware('auth')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('home.user');
});

Route::prefix('user/')->middleware('auth')->group(function() {

    //Usuário
    Route::get('index', [UserController::class, 'index'])->name('home.user');
    Route::get('edit', [UserController::class, 'edit'])->name('edit.user');
    Route::post('update', [UserController::class, 'update'])->name('update.user');
    Route::post('delete', [UserController::class, 'delete'])->name('delete.user');


    Route::prefix('cotacao/')->group(function() {

        //cotacao
        Route::get('index', [CotacaoController::class, 'index'])->name('index.cotacao');
        Route::get('show', [CotacaoController::class, 'show'])->name('show.cotacao');
        Route::post('create', [CotacaoController::class, 'create'])->name('create.cotacao');

    });

});

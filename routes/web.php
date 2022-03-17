<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CambioController;
use App\Http\Controllers\TaxasController;
use App\Http\Controllers\MailerController;

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

Route::get('/', [CambioController::class, 'index'])->middleware(['auth']);

Route::get('/dashboard', [CambioController::class, 'index'])->middleware(['auth']);

Route::post('/', [CambioController::class, 'store'])->middleware(['auth']);

Route::get('/detalhe/{id}', [CambioController::class, 'detail'])->middleware(['auth']);

Route::get('/historico', [CambioController::class, 'list'])->middleware(['auth']);

Route::get('/taxas', [TaxasController::class, 'index'])->middleware(['auth']);

Route::post('/taxas', [TaxasController::class, 'store'])->middleware(['auth']);

Route::post('/envia-email', [MailerController::class, 'send'])->middleware(['auth']);

require __DIR__.'/auth.php';

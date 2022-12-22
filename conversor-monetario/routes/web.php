<?php

use App\Http\Controllers\ConsomeApiController;
use App\Http\Controllers\DadosFormController;
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

Route::post('/storeConversao', [ConsomeApiController::class, 'storeConversao'])->name('consome_api.store_conversao');

Route::get('/', [ConsomeApiController::class, 'index']);

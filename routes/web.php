<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Awesome\{AvaliableController, BuyController};

Route::get('/', [AvaliableController::class, 'index']);
Route::post('/buy', [BuyController::class, 'buy'])->name('buy');

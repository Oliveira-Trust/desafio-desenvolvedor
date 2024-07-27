<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ConversionController;

Route::get('/conversion', [ConversionController::class, 'show']);
Route::post('/conversion', [ConversionController::class, 'convert']);
Route::redirect('/', '/conversion');
<?php

use App\Http\Controllers\InstrumentController;
use Illuminate\Support\Facades\Route;

Route::get('/instruments', [InstrumentController::class, 'index']);
Route::post('/instruments/import', [InstrumentController::class, 'upload']);

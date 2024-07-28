<?php

use App\Http\Controllers\ConversorController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ConversorController::class, 'index']);

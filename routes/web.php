<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Awesome\{AvaliableController};

Route::get('/', [AvaliableController::class, 'index']);

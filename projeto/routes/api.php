<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::controller(ApiController::class)->group(function () {
    Route::post('arquivo', 'upload')->name('api.upload');
})->middleware('api');

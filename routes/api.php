<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('quotation', [\Oliveiratrust\Quotation\QuotationController::class, 'index']);
    Route::post('quotation', [\Oliveiratrust\Quotation\QuotationController::class, 'store']);
    Route::get('quotation/{id}', [\Oliveiratrust\Quotation\QuotationController::class, 'show']);
    Route::post('quotation/{id}/email', [\Oliveiratrust\Quotation\QuotationController::class, 'sendEmail']);

    Route::get('admin/currencies', [\Oliveiratrust\Currency\CurrencyController::class, 'index']);
    Route::get('admin/currencies/refresh', [\Oliveiratrust\Currency\CurrencyController::class, 'update']);

    Route::get('admin/fees', [\Oliveiratrust\Fee\FeeController::class, 'index']);
    Route::post('admin/fees', [\Oliveiratrust\Fee\FeeController::class, 'store']);
    Route::put('admin/fees/{id}', [\Oliveiratrust\Fee\FeeController::class, 'update']);
    Route::delete('admin/fees/{id}', [\Oliveiratrust\Fee\FeeController::class, 'destroy']);
});

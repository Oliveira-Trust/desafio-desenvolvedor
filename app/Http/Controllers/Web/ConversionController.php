<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\CurrencyConversionSevice;
use Illuminate\Http\JsonResponse;

class ConversionController extends Controller
{

    public function index(): JsonResponse
    {

        $service = resolve(CurrencyConversionSevice::class);
        $currencies = $service->listAllCurrencies();

        return response()->json([
            'message' => 'Welcome to the currency conversion'
        ]);
    }
}

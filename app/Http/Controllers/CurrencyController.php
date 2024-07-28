<?php

namespace App\Http\Controllers;

use App\Services\AwesomeApiService;
use Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    protected AwesomeApiService $awesomeApiService;

    public function __construct(AwesomeApiService $awesomeApiService)
    {
        $this->awesomeApiService = $awesomeApiService;
    }

    /**
     * Get all currencies.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $currencies = $this->awesomeApiService->getCurrencies();

        if (isset($currencies['error'])) {
            return response()->json(['message' => $currencies['error']], 500);
        }

        return response()->json($currencies);
    }

    /**
     * Get a specific currency by code.
     *
     * @param string $code
     * @return JsonResponse
     */
    public function show(string $code): JsonResponse
    {
        $currency = $this->awesomeApiService->getCurrency($code);

        if (isset($currency['error'])) {
            return response()->json(['message' => $currency['error']], 500);
        }

        return response()->json($currency);
    }
}

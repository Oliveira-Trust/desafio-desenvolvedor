<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConsumeApiService;
use \Exception;

class CurrencyController extends Controller
{
    private object $consumeApiService;

    public function __construct(ConsumeApiService $consumeApiService)
    {
        $this->consumeApiService = $consumeApiService;
    }

    public function __invoke(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $currencyList = $this->consumeApiService->fetchCurrencyList();

        return response()->json([
            'success' => true,
            'values' => $currencyList
        ], 200);
        } catch (Exception $e) {
            $statusCode = $e->getCode() >= 100 && $e->getCode() < 600? $e->getCode(): 500;
            return response()->json([
                'error' => true,
                'message' => $e->getMessage()
            ], $statusCode);
        }
    }
}

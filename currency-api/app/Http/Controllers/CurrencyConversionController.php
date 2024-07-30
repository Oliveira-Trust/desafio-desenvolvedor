<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyConversionRequest;
use App\Services\AwesomeAPI\AwesomeAPIService;
use App\Services\CurrencyConversionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CurrencyConversionController extends Controller
{
    function __construct(
        private readonly AwesomeAPIService $awesomeAPIService,
        private readonly CurrencyConversionService $currencyConversionService
    ) { }

    /**
     * List all available currencies.
     *
     * @return JsonResponse
     */
    public function getAvailableCoins(): JsonResponse
    {
        try {
            return response()->json($this->awesomeAPIService->getAvailableCurrencies());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Houve um erro ao solicitar lista à API'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function getHistory(): JsonResponse
    {
        $authId = Auth::user()->getAuthIdentifier();

        try {
            $result = $this->currencyConversionService->getConversionsHistoryByUserId(
                $authId
            );

            return response()->json(['data' => $result], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function convert(CurrencyConversionRequest $request): JsonResponse
    {
        try {
            $result = $this->currencyConversionService->convert(
                $request->input('target_coin'),
                $request->input('amount'),
                $request->input('payment_method'),
                $request->user()->id
            );

            return response()->json(['data' => $result], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

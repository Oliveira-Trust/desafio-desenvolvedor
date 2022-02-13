<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Exceptions\BusinessRuleExceptions;
use App\Services\CurrencyConversionService;
use App\Http\Adapters\CurrencyConversionAdpter;
use App\Http\Requests\CurrencyConversionRequest;
use App\Http\Resources\CurrencyConversionResource;

class CurrencyConversionController extends Controller
{
    protected CurrencyConversionService $currencyConversionService;

    public function __construct(CurrencyConversionService $currencyConversionService)
    {
        $this->currencyConversionService = $currencyConversionService;
    }

    public function registerConversionAction(CurrencyConversionRequest $request): JsonResponse
    {
        $requestAdapter = new CurrencyConversionAdpter($request);

        try {
            $this->currencyConversionService->registerConversion($requestAdapter);

            return response()->json(
                'sucesso',
                200
            );
            return $this->currencyConversionService->registerConversion($requestAdapter);
        } catch (BusinessRuleExceptions $exception) {
            return response()->json(
                $exception->getError(),
                $exception->getHttpStatus()
            );
        }
    }

    public function historicConversionAction(): JsonResponse
    {
        try {
            $response = new CurrencyConversionResource(
                $this->currencyConversionService->historicConversion()
            );

            return response()->json(
                $response,
                200
            );
            return $this->currencyConversionService->registerConversion($requestAdapter);
        } catch (BusinessRuleExceptions $exception) {
            return response()->json(
                $exception->getError(),
                $exception->getHttpStatus()
            );
        }
    }
}

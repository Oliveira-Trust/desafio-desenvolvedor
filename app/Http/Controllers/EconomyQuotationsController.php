<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\EconomyQuotationFormRequest;
use App\Services\EconomyQuotationServices;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class EconomyQuotationsController extends Controller
{
    private EconomyQuotationServices $economyQuotationServices;

    public function __construct(EconomyQuotationServices $economyQuotationServices)
    {
        $this->economyQuotationServices = $economyQuotationServices;
    }

    /**
     * @throws RequestException
     * @throws Throwable
     */
    public function translations(): JsonResponse
    {
        $translations = $this->economyQuotationServices->translations()->sort();

        return response()->json(
            $translations,
            Response::HTTP_OK
        );
    }

    /**
     * @throws RequestException
     * @throws Throwable
     */
    public function combinations(): JsonResponse
    {
        $combinations = $this->economyQuotationServices->combinations()->json();

        return response()->json(
            $combinations,
            Response::HTTP_OK
        );
    }

    /**
     * @throws RequestException
     * @throws Throwable
     */
    public function conversion(EconomyQuotationFormRequest $economyQuotationRequest): JsonResponse
    {
        $attributes = $economyQuotationRequest->validated();
        $conversion = $this->economyQuotationServices->conversion($attributes);

        return response()->json(
            $conversion,
            Response::HTTP_OK
        );
    }
}

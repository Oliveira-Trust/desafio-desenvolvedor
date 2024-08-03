<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeFeeConfigurationRequest;
use App\Services\ExchangeFeeConfigurationService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ExchangeFeeConfigurationController extends Controller
{
    function __construct(
        private readonly ExchangeFeeConfigurationService $configConversionFeeService
    ) { }

    /**
     * List all available currencies.
     *
     * @return JsonResponse
     */
    public function getConfig(): JsonResponse
    {
        try {
            return response()->json($this->configConversionFeeService->getFeeConfiguration());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Houve um erro ao solicitar lista à API'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function setConfig(ExchangeFeeConfigurationRequest $request): JsonResponse
    {
        try {
            $result = $this->configConversionFeeService->setConfiguration(
                $request->input('amount_threshold'),
                $request->input('lower_than_threshold'),
                $request->input('greater_than_threshold'),
                $request->input('effective_date'),
            );

            return response()->json(['data' => $result], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}

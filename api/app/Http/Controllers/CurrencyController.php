<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ConsumeApiService;
use \Exception;
use \Illuminate\Http\JsonResponse;

class CurrencyController extends Controller
{
    private ConsumeApiService $consumeApiService;

    public function __construct(ConsumeApiService $consumeApiService)
    {
        $this->consumeApiService = $consumeApiService;
    }

    public function __invoke(): JsonResponse
    {
        try {
            $currencyList = $this->consumeApiService->fetchCurrencyList();

            return $this->sendResponse($currencyList, 'Lista de moedas encontrada com sucesso');
        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro ao buscar moedas');
        }
    }
}

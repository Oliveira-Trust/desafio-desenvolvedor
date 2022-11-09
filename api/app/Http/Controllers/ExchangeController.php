<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ExchangeService;
use Illuminate\Support\Facades\Auth;
use App\Traits\GeneralHelper;
use \Exception;

class ExchangeController extends Controller
{
    use GeneralHelper;
    private object $exchangeService;
    private object|null $user;

    public function __construct()
    {
        $this->exchangeService = app(ExchangeService::class);
        $this->user = Auth::user();
    }

    public function simulateExchange(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $input = $request->all();

            $this->exchangeService->validateInput($input);

            $exchange = $this->exchangeService->simulateExchange($input);

            if ($this->user) {
                $this->exchangeService->saveExchange($this->user, $exchange);
            }

            return response()->json([
                'success' => true,
                'values' => $exchange
            ], 200);

        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro ao simular conversão');
        }
    }

    public function getUserExchanges(): \Illuminate\Http\JsonResponse
    {
        try {
            $exchangeList = [];
            if ($this->user) {
                $exchangeList = $this->exchangeService->getExchangesByUserId($this->user);
            }

            return response()->json([
                'success' => true,
                'values' => $exchangeList
            ], 200);

        } catch (Exception $e) {
            return $this->responseWithError($e, 'Erro ao buscar simulações de conversão');
        }
    }
}

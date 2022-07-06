<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeStoreRequest;
use App\Models\UserHistory;
use App\Services\AwesomeAPI\AwesomeAPI;
use App\Services\ExchangeService;
use App\Services\UserHistoryService;

class ExchangeController extends Controller
{
    private $user_history_service;
    private $exchange_service;
    private $awesome_api;

    public function __construct(ExchangeService $exchange_service, UserHistoryService $user_history_service, AwesomeAPI $awesome_api)
    {
        $this->user_history_service = $user_history_service;
        $this->exchange_service = $exchange_service;
        $this->awesome_api = $awesome_api;
    }

    public function create()
    {
        return view('exchange.create', [
            'currencies' => $this->awesome_api->getAvailableCurrencies()
        ]);
    }

    public function store(ExchangeStoreRequest $request)
    {
        // REGATANDO COTAÇÃO
        $quote = $this->awesome_api->getCurrencyQuote(
            config('currency.origin'),
            $request->destination_currency
        );

        // TRANSFORMANDO DADOS PARA CÁLCULO DE TAXAS
        $exchange = $this->exchange_service->applyFees($request->except('_token'), $quote);

        // REGISTRANDO HISTÓRICO
        $user_history = $this->user_history_service->saveHistory(
            new UserHistory($exchange)
        );

        return redirect()->route('user-history.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Models\Currency;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{
    private $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        $this->currencyService = $currencyService;
    }

    public function index()
    {
        $currencies = $this->currencyService->getAllCurrencies();

        return view('currency.index', compact('currencies'));
    }

    public function create()
    {
        return view('currency.create');
    }

    public function store(CurrencyRequest $request)
    {
        $currency = $this->currencyService->storeCurrency((array)$request->validated());

        return redirect()->route('currencies.index')->with('message', 'Moeda cadastrada com sucesso!');
    }

    public function edit(Currency $currency)
    {
        return view('currency.edit', compact('currency'));
    }

    public function update(CurrencyRequest $request, $currency)
    {
        $result = $this->currencyService->updateCurrency($currency, (array)$request->validated());

        return redirect()->route('currencies.index')->with('message', 'Moeda alterada com sucesso!');
    }
}

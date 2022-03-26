<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyCurrencyRequest;
use App\Http\Resources\CurrencyPurchaseResource;
use App\Services\CurrencyService;

class CurrencyController extends Controller
{

    public function __construct(
        private CurrencyService $currencyService)
    {}

    public function index()
    {
        $currenciesPurchases = $this->currencyService->getPurchases();
        return view('dashboard', compact('currenciesPurchases'));
    }

    public function getCurrenciesPurchases()
    {
        return CurrencyPurchaseResource::collection($this->currencyService->getPurchases());
    }

    public function getCurrencies()
    {
        return $this->currencyService->getCurrencies();
    }

    public function buyCurrency(BuyCurrencyRequest $request)
    {
        return $this->currencyService->buyCurrency($request->all());
    }

    public function getConvertedCurrency(BuyCurrencyRequest $request)
    {
        return $this->currencyService->getConvertedCurrency($request->all());
    }

}

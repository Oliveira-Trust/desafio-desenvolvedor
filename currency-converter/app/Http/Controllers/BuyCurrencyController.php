<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyRequest;
use App\Models\BuyCurrencyModel;
use App\Services\CurrencyService;

class BuyCurrencyController extends Controller
{
    public function index(CurrencyService $currencyService)
    {
        return view('buy.index', [
            'paymentTypeOptions' => $currencyService->formapPaymentType(),
            'destinationCurrencyOptions' => $currencyService->getPossibleCurrencyOptionsTo(
                CurrencyService::DEFAULT_CURRENCY_ORIGIN
            ),
            'rules' => [
                'floorValueToBuy' => $currencyService::getFloorValueToBuy(),
                'ceilValueToBuy' => $currencyService::getCeilValueToBuy(),
            ]
        ]);
    }

    public function buy(BuyRequest $buyRequest, CurrencyService $currencyService)
    {
        $currencyService->buy(new BuyCurrencyModel($buyRequest->all()));
        return $buyRequest->all();
    }
}

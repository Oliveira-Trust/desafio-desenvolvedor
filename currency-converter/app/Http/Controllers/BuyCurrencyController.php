<?php

namespace App\Http\Controllers;

use App\Http\Requests\BuyRequest;
use App\Models\BuyCurrencyModel;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

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
        $buy = $this->buyApi($buyRequest, $currencyService);

        if (!$buy) {
            throw new \Exception();
        }

        return redirect('currency-converter')
            ->with(
                'buyStatus',
                /** forma divertida de pegar apenas os dados acessiveis */
                json_decode(json_encode($buy)
            ));
    }

    public function buyApi(BuyRequest $buyRequest, CurrencyService $currencyService)
    {
        $buy = $currencyService->buy(
            new BuyCurrencyModel($buyRequest->all())
        );

        if (!$buy) {
            /** @todo criar uma exception específica */
            throw new \Exception();
        }

        return $buy;
    }
}

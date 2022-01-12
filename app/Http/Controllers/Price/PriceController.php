<?php

namespace App\Http\Controllers\Price;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Domain\PaymentType\Services\PaymentTypeService;
use App\Domain\Currency\Services\CurrencyService;
use App\Domain\Price\Requests\PriceStoreRequest;
use App\Domain\Price\Services\PriceService;
use App\Domain\Fee\Services\FeeService;
use Auth;

class PriceController extends Controller
{
    public function __construct(PaymentTypeService $paymentType, CurrencyService $currency,
                                FeeService $fee, PriceService $price)
    {
        $this->paymentTypeService = $paymentType;
        $this->currencyService = $currency;
        $this->feeService = $fee;
        $this->priceService = $price;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentTypes = $this->paymentTypeService->getAllPaymentTypes();

        $currencyCodes = $this->currencyService->getAllCurrencyCodes();

        $data = session()->get('data');

        $userType = Auth::user()->type;

        return view('price.create', [
            'paymentTypes'  => $paymentTypes,
            'currencyCodes' => $currencyCodes,
            'data'          => $data,
            'userType'      => $userType
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     */
    public function store(PriceStoreRequest $request)
    {
        $data = [];

        $data['request'] = $request->toArray();

        //Pega os dados da moeda escolhida
        $currencyCode = $this->currencyService->getCurrencyCode($data['request']['targetCurrency']);

        //Pega cotação vi API
        $data['priceData'] = $this->priceService->getPriceData($currencyCode);

        if(!$data['priceData']) {
            return  redirect()->route('price.create')->withErrors('Não foi possivel realizar a cotação, tente mais tarde');
        }

        //calcular o fee pela transacao
        $data['defaultServiceFee'] = $this->feeService->getDefaultFee($data['request']['amount'], $data['request']['amount']);

        //criar copia de amount - defaultServiceFee
        $data['amountLeft'] = $this->feeService->subtractFeesFromAmount([$data['defaultServiceFee']], $data['request']['amount']);

        //pega o tipo de pagamento e o fee
        $data['paymentMethod'] = $this->paymentTypeService->getPaymentType($data['request']['paymentMethod']);

        //calcular o fee pelo tipo de pagamento
        $data['paymentMethodFee'] = $this->feeService->getFeeByPaymentMethod($data['request']['amount'], $data['amountLeft'], $data['paymentMethod']['class_name']);

        if(!$data['paymentMethodFee']) {
            return  redirect()->route('price.create')->withErrors('Não foi possivel realizar a cotação, as taxas provavelmente estão muito altas');
        }

        //restante usado apos deduzir taxas
        $data['amountUsedAfterTaxes'] = $this->feeService->subtractFeesFromAmount([$data['defaultServiceFee'],$data['paymentMethodFee']], $data['request']['amount']);

        //Calcula quanto deu pra comprar com o que sobrou após deduzir as taxas
        $data['amountBought'] = $this->priceService->calculateAmountBought($data['priceData']['bid'], $data['amountUsedAfterTaxes']);

        $dataForView = $this->priceService->prepareDataForView($data);

        //Salvaria cotação no banco para consulta de historico aqui...

        return redirect()->route('price.create')
          ->with('success', 'Cotação realizada')
          ->with(['data' => $dataForView]);
    }


}

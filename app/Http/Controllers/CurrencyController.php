<?php

namespace App\Http\Controllers;

use App\Services\CurrencyService;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * @var CurrencyService
     */
    private $service;

    /**
     * @param CurrencyService $service
     */
    function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $availableCurrencies = $this->service->getAvaliableCurrencies();
        $availablePaymentMethods = config('payment_methods');

        return view('front.templates.currency', compact(
            'availableCurrencies',
            'availablePaymentMethods'
        ));
    }

    /**
     * @param CurrencyRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \App\Services\AwesomeApi\Exceptions\AwesomeSDKException
     */
    public function convert(CurrencyRequest $request)
    {
        $calcule = $this->service->calculeConversion($request->get('value'), $request->get('currency'), $request->get('payment_method'));

        return redirect()->back()->with(['result' => $calcule]);
    }
}

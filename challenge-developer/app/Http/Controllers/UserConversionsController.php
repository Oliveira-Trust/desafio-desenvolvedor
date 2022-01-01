<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserConversion;
use App\Models\UserConversionResponse;
use Illuminate\Support\Facades\Redirect;

class UserConversionsController extends Controller
{
    public function recordCreationAndCurrencyConversion(Request $request)
    {
        $conversion = $this->create($request->all());

        $this->convertCurrency($conversion, $request);

        return Redirect::route('history.show');
    }

    public function create(Array $conversion)
    {
        $conversion = UserConversion::create([
            'user_id' => auth()->user()->id,
            'currency_origin' => $conversion['currency_origin'],
            'currency_destiny' => $conversion['currency_destiny'],
            'value' => $conversion['value'],
            'payment_method' => $conversion['payment_method'],
        ]);

        return $conversion;
    }

    public function convertCurrency(UserConversion $conversion, Request $request)
    {
        $currency = $conversion->getCurrencyQuote($request->currency_origin, $request->currency_destiny);

        $responseConvertion = [
            'currencyValue' => 0,
            'purchasedValue'  => 0,
            'payRate' => 0,
            'conversionRate' => 0,
            'valueWithoutFees' => 0,
        ];

        // Valor moeda de destino
        $responseConvertion['currencyValue'] = $request->currency_destiny === UserConversion::USD
                                ? $currency->BRLUSD->bid
                                : $currency->BRLEUR->bid;

        // Taxa de conversão
        $responseConvertion['conversionRate'] = $request->value < UserConversion::VALUE_CONVERSION
                                                        ? $request->value * (2 / 100)
                                                        : $request->value * (1 / 100);

        // Taxa de pagamento
        $responseConvertion['payRate'] = $request->payment_method === UserConversion::PAYMENT_TICKET
                                                ? $request->value * (UserConversion::PERCENT_TICKET / 100)
                                                : $request->value * (UserConversion::PERCENT_CREDIT_CARD / 100);

        // valor descontado das taxas
        $responseConvertion['valueWithoutFees'] = $request->value - ($responseConvertion['payRate'] + $responseConvertion['conversionRate']);

        // Valor convertido da compra
        $responseConvertion['purchasedValue'] = $responseConvertion['valueWithoutFees'] * $responseConvertion['currencyValue'];

        $this->createUserConversionResponse($conversion, $responseConvertion);
    }

    public function createUserConversionResponse(UserConversion $conversion, Array $responseConvertion)
    {
        UserConversionResponse::create([
            'user_conversion_id' => $conversion->id,
            'pay_rate' => $responseConvertion['payRate'],
            'conversion_rate' => $responseConvertion['conversionRate'],
            'value_without_fees' => $responseConvertion['valueWithoutFees'],
            'currency_value' => $responseConvertion['currencyValue'],
            'purchased_value' => $responseConvertion['purchasedValue'],
        ]);

        return Redirect::route('history.show');
    }

}

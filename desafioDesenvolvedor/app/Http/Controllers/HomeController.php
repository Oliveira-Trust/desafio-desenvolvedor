<?php

namespace App\Http\Controllers;

use App\User;
use App\QuotationHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function quote(Request $request)
    {

        $user = Auth::user();

        $currencyFromValue =  $this->feeToValue($request->currencyFrom);
        $paymentTypeValue =  $this->feeToPaymentType($currencyFromValue['value'], $request->paymentType);
        $currencyQuoteValue =  $this->finalQuote($paymentTypeValue['value'], $request->currencyQuote);

        $valueDescountFee = $request->currencyFrom - ($currencyFromValue['fee'] + $paymentTypeValue['fee']);

        $quoteHistory = new QuotationHistory();
        $quoteHistory->setCurrencyFromAttribute($request->currencyFrom);
        $quoteHistory->currency_to = $request->currencyTo;
        $quoteHistory->payment_type = $request->paymentType;
        $quoteHistory->setQuoteValueAttribute($currencyQuoteValue['value']);
        $quoteHistory->name = $currencyQuoteValue['name'];
        $quoteHistory->setBidAttribute($currencyQuoteValue['bid']);
        $quoteHistory->create_date = $currencyQuoteValue['create_date'];
        $quoteHistory->fk_user = $user->id;

        $quoteHistory->save();

        return [
            'currencyTo' => $request->currencyTo,
            'valueInit' => $request->currencyFrom,
            'paymentType' => $request->paymentType,
            'currencyQuote' => $currencyQuoteValue['bid'],
            'valueFinal' => $currencyQuoteValue['value'],
            'paymentFee' => $currencyFromValue['fee'],
            'quoteFee' => $paymentTypeValue['fee'],
            'valueDescountFee' => $valueDescountFee
        ];

    }

    public function feeToValue(string $value)
    {
        if ($value <= 3000) {
            $value = $value + ($value * 0.02);
            $fee = $value * 0.02;
        }

        if ($value > 3000) {
            $value = $value + ($value * 0.01);
            $fee = $value * 0.01;
        }

        return [
            'value' => $value,
            'fee' => $fee
        ];
    }

    public function feeToPaymentType(string $value, string $paymentType)
    {
        /**
         * 1 - Boleto
         * 2 - Cartão de Crédito
         */
        if ($paymentType == 1) {
            $value = $value + ($value * 0.0145);
            $fee = $value * 0.0145;
        }

        if ($paymentType == 2) {
            $value = $value + ($value * 0.0763);
            $fee = $value * 0.0763;
        }

        return [
            'value' => $value,
            'fee' => $fee
        ];
    }

    public function finalQuote(String $value, $currencyQuote)
    {

        foreach ($currencyQuote as $key => $currency) {
            $value = number_format($value / $currency['bid'], 2, ',', '.');
        }

        return [
            'bid' => $currency['bid'],
            'name' => $currency['name'],
            'create_date' => $currency['create_date'],
            'value' => $value
        ];
    }
}

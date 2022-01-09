<?php

namespace App\Http\Controllers;

use App\QuotationHistory;
use Illuminate\Http\Request;

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
        var_dump($request->all());

        $currencyFromValue =  $this->feeToValue($request->currencyFrom);
        $paymentTypeValue =  $this->feeToPaymentType($currencyFromValue, $request->paymentType);
        $currencyQuoteValue =  $this->directQuote($paymentTypeValue, $request->currencyQuote);

        $quoteHistory = new QuotationHistory();
        $quoteHistory->currency_from = $request->currencyFrom;
        $quoteHistory->currency_to = $request->currencyTo;
        $quoteHistory->payment_type = $request->paymentType;
        $quoteHistory->quote_value = $currencyQuoteValue['value'];
        $quoteHistory->name = $currencyQuoteValue['name'];
        $quoteHistory->bid = $currencyQuoteValue['bid'];
        $quoteHistory->create_date = $currencyQuoteValue['create_date'];

        $quoteHistory->save();
    }

    public function feeToValue(string $value)
    {
        if ($value <= 3000) {
            $value = $value + ($value * 0.02);
        }

        if ($value > 3000) {
            $value = $value + ($value * 0.01);
        }

        return $value;
    }

    public function feeToPaymentType(string $value, string $paymentType)
    {
        /**
         * 1 - Boleto
         * 2 - Cartão de Crédito
         */
        if ($paymentType == 1) {
            $value = $value + ($value * 0.0145);
        }

        if ($paymentType == 2) {
            $value = $value + ($value * 0.0763);
        }

        return $value;
    }

    public function directQuote(String $value, $currencyQuote)
    {

        foreach ($currencyQuote as $key => $currency) {
            $value = number_format($value / $currency['bid'], 2, ',', '.');
        }

        return [
            'value' => $value,
            'name' => $currency['name'],
            'bid' => $currency['bid'],
            'create_date' => $currency['create_date']
        ];
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Services\CurrencyServices\CurrencyService;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\CurrencyExchangeService;
use App\Services\PaymentMethodService;
use Exception;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected CurrencyService $currencyService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->currencyService = new CurrencyService();
    }

    public function home()
    {
        $currencies = $this->currencyService->listCurrencies();
        $paymentMethods = PaymentMethodService::listPaymentMethods();
        return view('home', [ 'currencies' => $currencies, 'paymentMethods' => $paymentMethods ]);
    }

    public function getLastExchangeRate(Request $request, string $currencyExchange)
    {
        $request->validate([
            'amount' => 'numeric|between:1000,100000',
        ]);

        $data = $this->currencyService->lastExchange($currencyExchange);
        if (is_array($data) && !$data[0]) {
            return response()->json([ 'success' => false, 'message' => $data[1] ], RESPONSE::HTTP_BAD_REQUEST);
        }

        $currencyCode = implode(explode("-", $currencyExchange));
        $currency_exchange_rate = ($data->{$currencyCode}->high + $data->{$currencyCode}->low) / 2;
        $currency_exchange_rate = $currency_exchange_rate;

        $amount = (float) $request->input('amount');
        $amount_tax = ($amount > 3000) ? 0.01 : 0.03;
        $amount_tax = $amount * $amount_tax;
        
        $payment_method = PaymentMethodService::getPaymentMethod($request->input('payment_method'));
        $payment_method_tax = $amount * $payment_method->fee_value;

        $amount_after_tax = $amount - $amount_tax - $payment_method_tax;

        $total_amount = $amount_after_tax * $currency_exchange_rate;

        $response = [
            'payment_method_tax' => round($payment_method_tax, 2),
            'amount_tax' => round($amount_tax, 2),
            'final_amount' => round($amount_after_tax, 2),
            'rate_exchange' => round($currency_exchange_rate, 2),
            'total_amount' => round($total_amount, 2),
        ];

        CurrencyExchangeService::storeExchangeCalc([
            'from_currency' => explode("-", $currencyExchange)[0],
            'to_currency' => explode("-", $currencyExchange)[1],
            'currency_value' => $currency_exchange_rate,
            'payment_method_id' => $payment_method->id,
            'payment_method_rate' => $payment_method->fee_value,
            'payment_method_tax' => $payment_method_tax,
            'amount' => $amount,
            'amount_tax' => $amount_tax,
            'amount_after_taxes' => $amount_after_tax,
            'net_total' => $total_amount,
        ]);

        return response()->json([ 'success' => true, 'data' => $response ], Response::HTTP_OK);
    }

    public function getExchangeHistory()
    {
        $history = CurrencyExchangeService::getUserHistory();
        return response()->json([ 'success' => true, 'data' => $history ], Response::HTTP_OK);
    }

    public function deleteExchangeHistory()
    {
        try {
            CurrencyExchangeService::deleteUserHistory();
            return response()->json([ 'success' => true ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([ 'success' => false, 'message' => $ex->getMessage() ], Response::HTTP_BAD_REQUEST);
        }
    }
}

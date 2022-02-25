<?php

namespace App\Http\Controllers;

use App\Enums\CurrencyOrigin;
use App\Enums\CurrencyTarget;
use App\Enums\PaymentMethod;
use App\Helpers\FormatsTrait;
use App\Http\Requests\ToConvertRequest;
use App\Services\CurrencyExchangeService;
use Illuminate\Support\Facades\Auth;

class CurrencyQuoteController extends Controller
{
    use FormatsTrait;

    public function index()
    {
        $options = $this->getOptions();
        $quotationHistory = $this->getQuotationHistoryByUser();

        return view('currencyQuote.index', compact('options', 'quotationHistory'));
    }

    public function toConvert(CurrencyExchangeService $currencyExchangeService, ToConvertRequest $request)
    {
        $value = $this->formatCurrencyBrlToDecimal($request->value);

        $currencyExchangeService->registerExchange($value, $request->currency_origin, $request->target_currency, $request->payment_method);

        $options = $this->getOptions();

        $quotationHistory = $this->getQuotationHistoryByUser();

        return view('currencyQuote.index', compact('quotationHistory', 'options'));
    }

    private function getOptions(): array
    {
        return [
            'currencyOrigin' => CurrencyOrigin::cases(),
            'currencyTarget' => CurrencyTarget::cases(),
            'paymentMethod' => PaymentMethod::cases()
        ];
    }

    private function getQuotationHistoryByUser()
    {
        return (Auth::user())->load('quotationHistory')->quotationHistory;
    }
}

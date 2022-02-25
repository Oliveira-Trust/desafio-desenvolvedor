<?php

namespace App\Http\Controllers;

use App\Enums\CurrencyOrigin;
use App\Enums\CurrencyTarget;
use App\Enums\PaymentMethod;
use App\Helpers\FormatsTrait;
use App\Http\Requests\ToConvertRequest;
use App\Services\CurrencyExchangeService;

class CurrencyQuoteController extends Controller
{
    use FormatsTrait;

    public function index()
    {
        $options = $this->getOptions();
        return view('currencyQuote.index', compact('options'));
    }

    public function toConvert(CurrencyExchangeService $currencyExchangeService, ToConvertRequest $request)
    {
        $value = $this->formatCurrencyBrlToDecimal($request->value);

        $quotaInfo = $currencyExchangeService->calculateExchange($value, $request->currency_origin, $request->target_currency, $request->payment_method);

        $quota = $this->normalizerQuotaInfo($quotaInfo);

        $options = $this->getOptions();

        return view('currencyQuote.index', compact('quota', 'options'));
    }

    private function normalizerQuotaInfo(array $quotaInfo): array
    {
        return [
            ...$quotaInfo,
            'valueOrigin' => $this->formatCurrencyToBrl($quotaInfo['valueOrigin']),
            'valueOriginWithDiscount' => $this->formatCurrencyToBrl($quotaInfo['valueOriginWithDiscount']),
            'ratePayment' => $this->formatCurrencyToBrl($quotaInfo['ratePayment']),
            'rateConvert' => $this->formatCurrencyToBrl($quotaInfo['rateConvert']),
            'valueTargetCurrency' => $this->formatCurrencyToBrl($quotaInfo['valueTargetCurrency'], $quotaInfo['targetCurrency']),
            'valueBaseConvert' => $this->formatCurrencyToBrl($quotaInfo['valueBaseConvert']),
        ];
    }

    private function getOptions(): array
    {
        return [
            'currencyOrigin' => CurrencyOrigin::cases(),
            'currencyTarget' => CurrencyTarget::cases(),
            'paymentMethod' => PaymentMethod::cases()
        ];
    }
}

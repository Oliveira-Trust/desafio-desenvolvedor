<?php

namespace App\Http\Controllers;

use App\Enums\CurrencyOrigin;
use App\Enums\CurrencyTarget;
use App\Enums\PaymentMethod;
use App\Helpers\FormatsTrait;
use App\Http\Requests\ToConvertRequest;
use App\Jobs\QuotaMailJob;
use App\Models\QuotationHistory;
use App\Models\User;
use App\Services\CurrencyExchangeService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CurrencyQuoteController extends Controller
{
    use FormatsTrait;

    public function index(Request $request)
    {
        $options = $this->getOptions();
        $quotationHistory = $this->getQuotationHistoryByUser($request->user());

        return view('currencyQuote.index', compact('options', 'quotationHistory'));
    }

    public function toConvert(CurrencyExchangeService $currencyExchangeService, QuotationHistory $quotationHistory, ToConvertRequest $request)
    {
        $user = $request->user();

        $quotationHistory->value_origin = $this->formatCurrencyBrlToDecimal($request->value);
        $quotationHistory->currency_origin = $request->currency_origin;
        $quotationHistory->target_currency = $request->target_currency;
        $quotationHistory->payment_method = $request->payment_method;

        $currencyExchangeService->registerExchange($user, $quotationHistory);

        $options = $this->getOptions();

        $quotationHistory = $this->getQuotationHistoryByUser($user);

        return view('currencyQuote.index', compact('quotationHistory', 'options'));
    }

    public function sendToEmail(QuotationHistory $quotationHistory)
    {
        dispatch(new QuotaMailJob($quotationHistory));
        return to_route('currencyQuote.index');
    }

    private function getOptions(): array
    {
        return [
            'currencyOrigin' => CurrencyOrigin::cases(),
            'currencyTarget' => CurrencyTarget::cases(),
            'paymentMethod' => PaymentMethod::cases()
        ];
    }

    private function getQuotationHistoryByUser(User $user): Collection
    {
        return $user->load('quotationHistory')->quotationHistory;
    }
}

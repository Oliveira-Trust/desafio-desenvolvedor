<?php

namespace App\Services\Quote;

use App\Interface\Quote\QuoteServiceInterface;
use App\Interface\Currency\CurrencyServiceInterface;
use App\Services\Quote\QuoteCalculationService;
use App\Helpers\ApiResponse;
use Akaunting\Money\Money;
class QuoteService implements QuoteServiceInterface
{
    private $currencyService;
    private $origem_default;
    private $quoteCalculationService;
    public function __construct(CurrencyServiceInterface $currencyService, QuoteCalculationService $quoteCalculationService)
    {
        $this->currencyService = $currencyService;
        $this->origem_default = env('CURRENCY_ORIGIN', 'BRL');
        $this->quoteCalculationService = $quoteCalculationService;
    }

    public function getAvailableCurrencies(string $origin = null): array
    {
        $origin = $origin ?? $this->origem_default;
        $currencies = $this->currencyService->getAvailableCurrencies();

        $filteredCurrencies = collect($currencies['data'])->filter(function ($value, $key) use ($origin) {
            return strpos($key, $origin . '-') === 0;
        })->keys()->toArray();

        if (empty($filteredCurrencies)) {
            ApiResponse::throw(null,'No available currencies found.',404);
        }

        return $filteredCurrencies;
    }

    public function generateCurrencyQuote(string $origin, string $destination, float $value, string $type): array
    {
        $quotes = $this->currencyService->getLatestOccurrences([$origin.'-'.$destination]);
        if (empty($quotes)) {
            ApiResponse::throw(null,'No quotes found for the specified currencies.',404);
        }

        $data = [
            'origin' => $origin,
            'destination' => $destination,
            'value' => $value,
            'payment_method' => $type,
            'quotes' => $quotes,
        ];

        $result = $this->quoteCalculationService->calculateQuote($data);

        return $this->formatQuoteResult($result);
    }

    public function formatQuoteResult(array $quote): array
    {
        $result = [];
        $origin = $quote['origin_currency'];
        $destination = $quote['destination_currency'];
        $result['origin_currency'] = "{$origin}";
        $result['destination_currency'] = "{$destination}";
        $result['original_value'] = Money::$origin($quote['original_value'], true)->format();
        $result['payment_method'] = "{$quote['payment_method']}";
        $result['conversion_details']['original_amount'] = Money::$origin($quote['conversion_details']['original_amount'],true)->format();
        $result['conversion_details']['converted_amount'] = Money::$destination($quote['conversion_details']['converted_amount'],true)->format();
        $result['tax']['tax_rate_value'] = Money::$origin($quote['tax']['tax_rate_value'],true)->format();
        $result['tax']['tax_conversion_value'] = Money::$origin($quote['tax']['tax_conversion_value'],true)->format();
        $result['original_value_minus_tax'] = Money::$origin($quote['original_value'] - $quote['tax']['total_tax'],true)->format();

        return $result;
    }

    public function changeQuoteRates(string $userId, array $rates): void
    {
        // Update the quote rates for the specified user
    }

    public function sendQuoteByEmail(string $userId, string $email): void
    {
        // Send the quote by email to the specified user
    }
}
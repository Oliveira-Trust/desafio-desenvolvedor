<?php

namespace App\Services\Quote;

use App\Interface\Quote\QuoteServiceInterface;
use App\Interface\Quote\HistoricalQuoteInterface;
use App\Services\Quote\QuoteCalculationService;
use App\Interface\Currency\CurrencyServiceInterface;
use App\Interface\User\UserInterface;
use App\Helpers\ApiResponse;
use Akaunting\Money\Money;
use App\Mail\QuoteEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
class QuoteService implements QuoteServiceInterface
{
    private $currencyService;
    private $origem_default;
    private $quoteCalculationService;
    private $userInterface;
    private $historicalQuoteService;
    public function __construct(
        CurrencyServiceInterface $currencyService, 
        QuoteCalculationService $quoteCalculationService, 
        UserInterface $userInterface, 
        HistoricalQuoteInterface $historicalQuoteInterface
    )
    {
        $this->currencyService = $currencyService;
        $this->origem_default = env('CURRENCY_ORIGIN', 'BRL');
        $this->quoteCalculationService = $quoteCalculationService;
        $this->userInterface = $userInterface;
        $this->historicalQuoteService = $historicalQuoteInterface;
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

        $quote = $this->quoteCalculationService->calculateQuote($data);
        $quote_history = $this->generateHistoricalQuote(Auth::id(), $quote['histoty']);
        $result = $this->formatQuoteResult($quote['result'], $quote_history->id);

        return $result;
    }
    

    public function formatQuoteResult(array $quote, int $quote_id): array
    {
        $result = [];
        $origin = $quote['origin_currency'];
        $destination = $quote['destination_currency'];
        $result['quote_id'] = $quote_id;
        $result['origin_currency'] = "{$origin}";
        $result['destination_currency'] = "{$destination}";
        $result['original_value'] = Money::$origin($quote['original_value'], true)->format();
        $result['payment_method'] = "{$quote['payment_method']}";
        $result['conversion_details']['original_amount'] = Money::$origin($quote['conversion_details']['original_amount'],true)->format();
        $result['conversion_details']['converted_amount'] = Money::$destination($quote['conversion_details']['converted_amount'],true)->format();
        $result['conversion_details']['exchange_rate'] = Money::$destination($quote['conversion_details']['exchange_rate'],true)->format();
        $result['tax']['tax_rate_value'] = Money::$origin($quote['tax']['tax_rate_value'],true)->format();
        $result['tax']['tax_rate_value_porcentages'] = $quote['tax']['tax_rate_percentage'];
        $result['tax']['tax_conversion_value'] = Money::$origin($quote['tax']['tax_conversion_value'],true)->format();
        $result['tax']['tax_conversion_percentage'] = $quote['tax']['tax_conversion_percentage'];
        $result['tax']['tax_total'] = Money::$origin($quote['tax']['total_tax'],true)->format();
        $result['original_value_minus_tax'] = Money::$origin($quote['original_value'] - $quote['tax']['total_tax'],true)->format();

        return $result;
    }

    public function sendQuoteByEmail(int $userId,array $result): void
    {
        $user = $this->userInterface->getUserById($userId);
        Mail::to($user)->send(new QuoteEmail($result));
        $this->historicalQuoteService->update($result['quote_id'], ['email_sent_at' => now()]);
    }

    public function generateHistoricalQuote(string $userId, array $data)
    {
        return $this->historicalQuoteService->store($userId, $data);
    }

    public function getHistoricalQuotesByUserId(string $userId): array
    {
        return $this->userInterface->getHistoricalQuotesByUserId($userId);
    }
}
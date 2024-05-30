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
/**
 * Class QuoteService
 *
 * This class implements the QuoteServiceInterface and provides methods for handling currency quotes.
 */
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
    ) {
        $this->currencyService = $currencyService;
        $this->origem_default = config('services.converter.origin');
        $this->quoteCalculationService = $quoteCalculationService;
        $this->userInterface = $userInterface;
        $this->historicalQuoteService = $historicalQuoteInterface;
    }

    /**
     * Get the available currencies based on the origin.
     *
     * @param string|null $origin The origin currency (optional)
     * @return array The array of available currencies
     */
    public function getAvailableCurrencies(string $origin = null): array
    {
        $origin = $origin ?? $this->origem_default;
        $currencies = $this->currencyService->getAvailableCurrencies();

        if (empty($currencies) || empty($currencies['data'])) {
            ApiResponse::throw(null, 'No available currencies found.', 404);
        }

        $filteredCurrencies = collect($currencies['data'])->filter(function ($value, $key) use ($origin) {
            return strpos($key, $origin . '-') === 0;
        })->keys()->map(function ($item) {
            return explode('-', $item)[1];
        })->toArray();

        if (empty($filteredCurrencies)) {
            ApiResponse::throw(null, 'No available currencies found.', 404);
        }

        // Mapeando os códigos de moeda para seus nomes completos
        $currencyNames = collect($filteredCurrencies)->mapWithKeys(function ($currencyCode) {
            return [$currencyCode => $this->getName($currencyCode)];
        })->toArray();

        return $currencyNames;
    }

    public function getAvailableCurrenciesNormal(string $origin = null): array
    {
        $origin = $origin ?? $this->origem_default;
        $currencies = $this->currencyService->getAvailableCurrencies();

        $filteredCurrencies = collect($currencies['data'])->filter(function ($value, $key) use ($origin) {
            return strpos($key, $origin . '-') === 0;
        })->keys()->toArray();

        if (empty($filteredCurrencies)) {
            ApiResponse::throw(null, 'No available currencies found.', 404);
        }

        return $filteredCurrencies;
    }

    private function getName(string $currency): string
    {
        $currencies = $this->currencyService->getCurrencyNames();
        return $currencies['data'][$currency];
    }

    /**
     * Generate a currency quote based on the specified currencies, value, and payment type.
     *
     * @param string $origin The origin currency
     * @param string $destination The destination currency
     * @param float $value The value to be converted
     * @param string $type The payment type
     * @return array The generated currency quote
     */
    public function generateCurrencyQuote(string $origin, string $destination, float $value, string $type): array
    {
        $quotes = $this->currencyService->getLatestOccurrences([$origin . '-' . $destination]);
        if (empty($quotes)) {
            ApiResponse::throw(null, 'No quotes found for the specified currencies.', 404);
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
        $result = $this->formatQuoteResult($quote['result'], $quote_history);

        return $result;
    }

    /**
     * Format the currency quote result.
     *
     * @param array $quote The currency quote data
     * @param int $quote_id The quote ID
     * @return array The formatted currency quote result
     */
    public function formatQuoteResult(array $quote, $quote_history): array
    {
        $result = [];
        $origin = $quote['origin_currency'];
        $destination = $quote['destination_currency'];
        $result['quote_id'] = $quote_history->id;
        $result['created_at'] = $quote_history->created_at->format('d/m/Y H:i:s');
        $result['origin_currency'] = "{$origin}";
        $result['origin_currency_name'] = "{$this->getName($origin)}";
        $result['destination_currency'] = "{$destination}";
        $result['destination_currency_name'] = "{$this->getName($destination)}";
        $result['original_value'] = Money::$origin($quote['original_value'], true)->format();
        $result['payment_method'] = "{$quote['payment_method']}";
        $result['conversion_details']['original_amount'] = Money::$origin($quote['conversion_details']['original_amount'], true)->format();
        $result['conversion_details']['converted_amount'] = Money::$destination($quote['conversion_details']['converted_amount'], true)->format();
        $result['conversion_details']['exchange_rate'] = Money::$destination($quote['conversion_details']['exchange_rate'], true)->format();
        $result['tax']['tax_rate_value'] = Money::$origin($quote['tax']['tax_rate_value'], true)->format();
        $result['tax']['tax_rate_value_porcentages'] = $quote['tax']['tax_rate_percentage'];
        $result['tax']['tax_conversion_value'] = Money::$origin($quote['tax']['tax_conversion_value'], true)->format();
        $result['tax']['tax_conversion_percentage'] = $quote['tax']['tax_conversion_percentage'];
        $result['tax']['tax_total'] = Money::$origin($quote['tax']['total_tax'], true)->format();
        $result['original_value_minus_tax'] = Money::$origin($quote['original_value'] - $quote['tax']['total_tax'], true)->format();

        return $result;
    }

    /**
     * Send the currency quote by email to the specified user.
     *
     * @param int $userId The user ID
     * @param array $result The currency quote result
     * @return void
     */
    public function sendQuoteByEmail(int $userId, array $result): void
    {
        $user = $this->userInterface->getUserById($userId);
        $result['username'] = $user->name;
        Mail::to($user)->send(new QuoteEmail($result));
        $this->historicalQuoteService->update($result['quote_id'], ['email_sent_at' => now()]);
    }

    /**
     * Generate a historical quote for the specified user.
     *
     * @param string $userId The user ID
     * @param array $data The historical quote data
     * @return mixed The generated historical quote
     */
    public function generateHistoricalQuote(string $userId, array $data)
    {
        return $this->historicalQuoteService->store($userId, $data);
    }

    /**
     * Get the historical quotes for the specified user.
     *
     * @param string $userId The user ID
     * @return array The array of historical quotes
     */
    public function getHistoricalQuotesByUserId(string $userId): array
    {
        return $this->userInterface->getHistoricalQuotesByUserId($userId);
    }
}

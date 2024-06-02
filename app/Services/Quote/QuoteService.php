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
use App\Helpers\CurrencyHelper;
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
            throw new \Exception('No quotes found for the specified currencies.');
        }
  
        $data = [
            'origin' => $origin,
            'destination' => $destination,
            'value' => $value,
            'payment_method' => $type,
            'quotes' => $quotes,
        ];
        
        $quote = $this->quoteCalculationService->calculateQuote($data);

        $quote['origin_currency_name'] = "{$this->getName($origin)}";
        $quote['destination_currency_name'] = "{$this->getName($destination)}";

        $history = $this->historicalQuoteService->store(Auth::id(),$quote);
        $result = $this->formatQuoteResult($quote,$history);

        return $result;
    }

    /**
     * Format the currency quote result.
     *
     * @param array $quote The currency quote data
     * @param object $history The history object containing metadata
     * @return array The formatted currency quote result
     */
    public function formatQuoteResult(array $quote, object $history): array
    {
        $result = [];
        
        $origin = $quote['origin_currency'];
        $destination = $quote['destination_currency'];

        // Basic quote information
        $result['quote_id'] = $history->id;
        $result['created_at'] = $history->created_at->format('d/m/Y H:i:s');
        $result['origin_currency'] = $origin;
        $result['origin_currency_name'] = $this->getName($origin);
        $result['destination_currency'] = $destination;
        $result['destination_currency_name'] = $this->getName($destination);
        $result['original_value'] = $this->formatMoney($origin, $quote['original_amount']);
        $result['payment_method'] = $quote['payment_method'];

        // Conversion details
        $result['conversion_details'] = $this->formatConversionDetails($quote['conversion_details'], $origin, $destination);

        // Tax details
        $result['tax'] = $this->formatTaxDetails($quote['tax'], $origin);
        $result['original_value_minus_tax'] = $this->formatMoney($origin, $quote['tax']['amount_minus_tax']);

        return $result;
    }

    /**
     * Format conversion details.
     *
     * @param array $details Conversion details data
     * @param string $origin Origin currency
     * @param string $destination Destination currency
     * @return array Formatted conversion details
     */
    private function formatConversionDetails(array $details, string $origin, string $destination): array
    {
        return [
            'original_amount' => $this->formatMoney($origin, $details['original_amount']),
            'converted_amount' => $this->formatMoney($destination, $details['converted_amount']),
            'exchange_rate' => Money::$destination($details['exchange_rate'], true)->format(),
        ];
    }

    /**
     * Format tax details.
     *
     * @param array $tax Tax details data
     * @param string $currency Currency for formatting
     * @return array Formatted tax details
     */
    private function formatTaxDetails(array $tax, string $currency): array
    {
        return [
            'tax_rate_value' => $this->formatMoney($currency, $tax['tax_rate_amount']),
            'tax_rate_value_percentages' => $tax['tax_rate_percentage'],
            'tax_conversion_value' => $this->formatMoney($currency, $tax['tax_conversion_amount']),
            'tax_conversion_percentage' => $tax['tax_conversion_percentage'],
            'tax_total' => $this->formatMoney($currency, $tax['total_tax_amount']),
        ];
    }

    /**
     * Format money value.
     *
     * @param string $currency Currency code
     * @param float $amount Amount to format
     * @return string Formatted money value
     */
    private function formatMoney(string $currency, float $amount): string
    {
        return Money::$currency(CurrencyHelper::toCurrency($amount), true)->format();
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
        Mail::to($user)->queue(new QuoteEmail($result));
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

<?php

namespace App\Interface\Quote;

/**
 * Interface for the Quote Service.
 */
interface QuoteServiceInterface
{
    /**
    * Check if the service is available.
    *
    * @return bool True if the service is available, false otherwise.
    */
    public function check():bool;
    
    /**
     * Get the available currencies for a given origin.
     *
     * @param string $origin The origin currency.
     * @return array An array of available currencies.
     */
    public function getAvailableCurrencies(string $origin): array;
    public function getAvailableCurrenciesNormal(string $origin): array;

    /**
     * Generate currency quotes for a single destination based on the origin currency.
     *
     * @param string $origin The origin currency.
     * @param string $destination The destination currency.
     * @param float $value The value to convert.
     * @param string $type The payment method. Enum: ['Boleto', 'CreditCard']
     * @return array The currency quote.
     */
    public function generateCurrencyQuote(string $origin, string $destination, float $value, string $type): array;

    /**
     * Send the currency quote by email to a specific user.
     *
     * @param int $userId The user ID.
     * @param array $quote The currency quote result.
     * @return void
     */
    public function sendQuoteByEmail(int $userId, array $quote): void;

    public function getHistoricalQuotesByUserId(string $userId): array;
}

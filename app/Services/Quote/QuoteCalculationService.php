<?php

namespace App\Services\Quote;

/**
 * Class QuoteCalculationService
 * 
 * This class is responsible for calculating the quote for a given data.
 */
class QuoteCalculationService
{
    /**
     * Calculate the quote based on the provided data.
     * 
     * @param array $data The data containing the origin, destination, and value.
     * @return array The conversion details including the origin currency, destination currency, original amount, converted amount, exchange rate, payment method, timestamp, create date, and conversion message.
     */
    public function calculateQuote($data){
        return $this->calculateConversion($data);
    }

    /**
     * Calculate the conversion based on the provided data.
     * 
     * @param array $data The data containing the origin, destination, and value.
     * @return array The conversion details including the origin currency, destination currency, original amount, converted amount, exchange rate, payment method, timestamp, create date, and conversion message.
     */
    public function calculateConversion($data)
    {
        $origin = $data['origin'];
        $destination = $data['destination'];

        $valueInCents = $this->toCents($data['value']);
        $askRate = $this->getAskRate($data, $origin, $destination);
        $askRateInCents = $this->toCents($askRate);

        $amountInDestinationCents = $this->calculateAmountInDestinationCents($valueInCents, $askRateInCents);
        $amountInOrigin = $this->toCurrency($valueInCents);
        $amountInDestination = $this->toCurrency($amountInDestinationCents);

        $conversionDetails = $this->createConversionDetails(
            $data, $amountInOrigin, $amountInDestination, $askRate
        );
        
        return $conversionDetails;
    }
    
    /**
     * Convert the amount to cents.
     * 
     * @param float $amount The amount to be converted.
     * @return int The amount in cents.
     */
    private function toCents($amount)
    {
        return (int) round($amount * 1000);
    }
    
    /**
     * Convert the amount in cents to currency.
     * 
     * @param int $amountInCents The amount in cents to be converted.
     * @return float The amount in currency.
     */
    private function toCurrency($amountInCents)
    {
        return round($amountInCents / 1000.0, 3);
    }
    
    /**
     * Get the ask rate for the given origin and destination.
     * 
     * @param array $data The data containing the quotes.
     * @param string $origin The origin currency.
     * @param string $destination The destination currency.
     * @return float The ask rate.
     */
    private function getAskRate($data, $origin, $destination)
    {
        return $data['quotes']["$origin-$destination"]['ask'];
    }
    
    /**
     * Calculate the amount in destination currency in cents.
     * 
     * @param int $valueInCents The value in cents.
     * @param int $askRateInCents The ask rate in cents.
     * @return int The amount in destination currency in cents.
     */
    private function calculateAmountInDestinationCents($valueInCents, $askRateInCents)
    {
        return (int) round($valueInCents * $askRateInCents / 1000, 3);
    }
    
    /**
     * Create the conversion details array.
     * 
     * @param array $data The data containing the origin, destination, quotes, and payment method.
     * @param int $valueInCents The value in cents.
     * @param float $amountInOrigin The amount in origin currency.
     * @param float $amountInDestination The amount in destination currency.
     * @param int $amountInDestinationCents The amount in destination currency in cents.
     * @param float $askRate The ask rate.
     * @param int $askRateInCents The ask rate in cents.
     * @return array The conversion details.
     */
    private function createConversionDetails($data, $amountInOrigin, $amountInDestination, $askRate)
    {
        return [
                'origin_currency' => $data['origin'],
                'destination_currency' => $data['destination'],
                'original_amount' => $amountInOrigin,
                'converted_amount' => $amountInDestination,
                'exchange_rate' => $askRate,
        ];
    }
}

<?php

namespace App\Services\Quote;

use App\Helpers\ApiResponse;
use Illuminate\Support\Facades\Auth;
use App\Interface\User\UserInterface;
use App\Helpers\CurrencyHelper;

/**
 * Class QuoteCalculationService
 *
 * This class is responsible for calculating quotes based on given data.
 */
class QuoteCalculationService
{
    private $user;

    // Constantes para as taxas
    private const BOLETO_TAX_RATE = 1.45;
    private const CREDIT_CARD_TAX_RATE = 7.63;
    private const DEFAULT_TAX_RATE = 0;
    private const DEFAULT_CONVERSION_FEE_ABOVE_THRESHOLD = 1;
    private const DEFAULT_CONVERSION_FEE_BELOW_THRESHOLD = 2;
    private const CONVERSION_FEE_THRESHOLD = 3000;

    /**
     * QuoteCalculationService constructor.
     *
     * @param UserInterface $user The user interface.
     */
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Calculate the quote based on the given data.
     *
     * @param array $data The data for calculating the quote.
     * @return array The calculated quote result.
     */
    public function calculateQuote(array $data): array
    {
        $original_valueInCents = CurrencyHelper::toCents($data['value']);

        $taxRate = $this->getTaxRate($data['payment_method']);
        $taxRateValue = $this->calculateTax($original_valueInCents, $taxRate);

        $taxConversion = $this->getTaxConversion($original_valueInCents, $data['payment_method']);
        $taxConversionValue = $this->calculateTax($original_valueInCents, $taxConversion);

        $valueInCents = $original_valueInCents - ($taxRateValue + $taxConversionValue);

        $result = [
            'original_amount' =>  $original_valueInCents,
            'origin_currency' => $data['origin'],
            'destination_currency' => $data['destination'],
            'payment_method' => $data['payment_method'],
            'tax' => $this->createTaxDetails($original_valueInCents,$taxRate, $taxRateValue, $taxConversion, $taxConversionValue),
            'conversion_details' => $this->calculateConversion($data, $valueInCents),
        ];

        return $result;
    }

    /**
     * Create the tax details based on the given tax rates and values.
     *
     * @param float $taxRate The tax rate percentage.
     * @param float $taxRateValue The tax rate value.
     * @param float $taxConversion The tax conversion percentage.
     * @param float $taxConversionValue The tax conversion value.
     * @return array The tax details.
     */
    private function createTaxDetails(int $amount, float $taxRate, int $taxRateValue, float $taxConversion, int $taxConversionValue): array
    {
        return [
            'tax_rate_percentage' => $taxRate,
            'tax_rate_amount' => $taxRateValue,
            'tax_conversion_percentage' => $taxConversion,
            'tax_conversion_amount' => $taxConversionValue,
            'total_tax_amount' => $taxRateValue + $taxConversionValue,
            'amount_minus_tax' =>  $amount - ($taxRateValue + $taxConversionValue),
        ];
    }

    /**
     * Calculate the conversion details based on the given data.
     *
     * @param array $data The data for calculating the conversion details.
     * @return array The conversion details.
     */
    public function calculateConversion(array $data, int $valueInCents): array
    {
        $origin = $data['origin'];
        $destination = $data['destination'];

        $askRate = $this->getAskRate($data, $origin, $destination);
        $askRateInCents = CurrencyHelper::toCents($askRate);  
        $amountInDestinationCents = $this->calculateAmountInDestinationCents($valueInCents, $askRateInCents);
        return $this->createConversionDetails($valueInCents, $amountInDestinationCents, $askRate);
    }

    /**
     * Create the conversion details based on the given amounts and exchange rate.
     *
     * @param float $amountInOrigin The amount in the origin currency.
     * @param float $amountInDestination The amount in the destination currency.
     * @param float $askRate The exchange rate.
     * @return array The conversion details.
     */
    private function createConversionDetails(int $amountInOrigin, int $amountInDestination, float $askRate): array
    {
        return [
            'original_amount' => $amountInOrigin,
            'converted_amount' => $amountInDestination,
            'exchange_rate' => $askRate,
        ];
    }

    /**
     * Get the tax rate based on the payment method.
     *
     * @param string $paymentMethod The payment method.
     * @return float The tax rate.
     */
    private function getTaxRate(string $paymentMethod): float
    {
        $taxConfig = $this->user->getUserConfigTax(Auth::user()->id, $paymentMethod);
        
        if ($taxConfig && isset($taxConfig->payment_method_fee)) {
            return $taxConfig->payment_method_fee;
        }
        
        switch ($paymentMethod) {
            case 'Boleto':
                return self::BOLETO_TAX_RATE;
            case 'CreditCard':
                return self::CREDIT_CARD_TAX_RATE;
            default:
                return self::DEFAULT_TAX_RATE;
        }
    }

    /**
     * Get the tax conversion based on the value and payment method.
     *
     * @param float $valueInCents The value in cents.
     * @param string $paymentMethod The payment method.
     * @return float The tax conversion.
     */
    private function getTaxConversion(float $valueInCents, string $paymentMethod): float
    {
        // Get tax configuration for the user and payment method
        $taxConfig = $this->getUserTaxConfig($paymentMethod);

        // Check if tax configuration is valid
        if ($taxConfig === null) {
            return $this->getDefaultConversionFee($valueInCents);
        }

        // Check if all necessary configuration parameters are available
        if (!isset($taxConfig->conversion_fee_threshold) ||
            !isset($taxConfig->conversion_fee_below_threshold) ||
            !isset($taxConfig->conversion_fee_above_threshold)) {
            return $this->getDefaultConversionFee($valueInCents);
        }

        $conversionFeeThreshold = CurrencyHelper::toCents($taxConfig->conversion_fee_threshold);

        if ($valueInCents <= $conversionFeeThreshold) {
            return $taxConfig->conversion_fee_below_threshold;
        }

        return $taxConfig->conversion_fee_above_threshold;
    }

    /**
     * Get the default conversion fee based on the value in cents.
     *
     * @param float $valueInCents The value in cents.
     * @return float The default conversion fee.
     */
    private function getDefaultConversionFee(float $valueInCents): float
    {
        if ($valueInCents <= CurrencyHelper::toCents(self::CONVERSION_FEE_THRESHOLD)) {
            return self::DEFAULT_CONVERSION_FEE_BELOW_THRESHOLD;
        }

        return self::DEFAULT_CONVERSION_FEE_ABOVE_THRESHOLD;
    }

    /**
     * Get user tax configuration for the specified payment method.
     *
     * @param string $paymentMethod The payment method.
     * @return object|null The user's tax configuration or null if not found.
     */
    private function getUserTaxConfig(string $paymentMethod): ?object
    {
        // Retrieve user tax configuration from the user service or repository
        $userId = Auth::id();
        return $this->user->getUserConfigTax($userId, $paymentMethod);
    }


    /**
     * Calculate the tax based on the given amount and tax rate.
     *
     * @param float $amount The amount.
     * @param float $tax The tax rate.
     * @return int The calculated tax.
     */
    private function calculateTax(float $amount, float $tax): int
    {
        return (int) ($amount * $tax / 100);
    }

    /**
     * Get the ask rate based on the given data, origin, and destination.
     *
     * @param array $data The data.
     * @param string $origin The origin currency.
     * @param string $destination The destination currency.
     * @return float The ask rate.
     * @throws \InvalidArgumentException If the input values are not positive.
     */
    private function getAskRate(array $data, string $origin, string $destination): float
    {
        $quoteKey = "$origin-$destination";
        
        if (!isset($data['quotes'][$quoteKey]['ask']) || !is_numeric($data['quotes'][$quoteKey]['ask'])) {
            throw new \Exception("Ask rate not found for $origin to $destination.", 404);
        }

        return (float) $data['quotes'][$quoteKey]['ask'];
    }

    /**
     * Calculate the amount in destination currency in cents.
     *
     * @param int $valueInCents The value in cents.
     * @param int $askRateInCents The ask rate in cents.
     * @return int The amount in destination currency in cents.
     * @throws \InvalidArgumentException If the input values are not positive.
     */
    private function calculateAmountInDestinationCents(int $valueInCents, int $askRateInCents): int
    {
        if ($valueInCents <= 0 || $askRateInCents <= 0) {
            throw new \Exception("Value and ask rate must be positive integers. (valueInCents: $valueInCents, askRateInCents: $askRateInCents)", 500);
        }

        // Multiply the value by the ask rate and then scale back to cents
        $amount = $valueInCents * $askRateInCents / CurrencyHelper::CONVERSION_FACTOR;

        // Round to the nearest whole number and return as an integer
        return (int) $amount;
    }

}
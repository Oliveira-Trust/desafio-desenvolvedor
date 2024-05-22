<?php
namespace App\Services\Quote;

use Illuminate\Support\Facades\Auth;
use App\Interface\User\UserInterface;
/**
 * Class QuoteCalculationService
 * 
 * This class is responsible for calculating quotes based on given data.
 */
class QuoteCalculationService
{
    private $user;    
    /**
     * QuoteCalculationService constructor.
     * 
     * @param UserInterface $user The user interface.
     */
    public function __construct(UserInterface $user) {
        $this->user = $user;
    }
    
    /**
     * Calculate the quote based on the given data.
     * 
     * @param array $data The data for calculating the quote.
     * @return array The calculated quote result.
     */
    public function calculateQuote($data)
    {
        $valueInCents = $this->toCents($data['value']);
        $originalValue = $data['value'];
        $taxRate = $this->getTaxRate($data['payment_method']);
        $taxRateValue = $this->calculateTax($valueInCents, $taxRate);
        $taxConversion = $this->getTaxConversion($valueInCents, $data['payment_method']);
        $taxConversionValue = $this->calculateTax($valueInCents, $taxConversion);

        $valueInCents = $valueInCents - ($taxRateValue + $taxConversionValue);

        $data['value'] = $this->toCurrency($valueInCents);

        $result = [
            'original_value' =>  $originalValue,
            'origin_currency' => $data['origin'],
            'destination_currency' => $data['destination'],
            'payment_method' => $data['payment_method'],
            'tax' => $this->createTaxDetails($taxRate, $taxRateValue, $taxConversion, $taxConversionValue),
            'conversion_details' => $this->calculateConversion($data),
        ];
        
        return [ 
            'result'=> $result,
            'histoty'=> $this->createHistoryDetails($result)
        ];
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
    private function createTaxDetails($taxRate, $taxRateValue, $taxConversion, $taxConversionValue)
    {
        return [
            'tax_rate_percentage' => $taxRate,
            'tax_rate_value' => $this->toCurrency($taxRateValue),
            'tax_conversion_percentage' => $taxConversion,
            'tax_conversion_value' => $this->toCurrency($taxConversionValue),
            'total_tax' => $this->toCurrency($taxRateValue + $taxConversionValue),
        ];
    }

    /**
     * Create the history details based on the given data.
     * 
     * @param array $data The data for creating history details.
     * @return array The history details.
     */
    private function createHistoryDetails($data)
    {
        return [
            'origin_currency' => $data['origin_currency'],
            'destination_currency' => $data['destination_currency'],
            'payment_method' => $data['payment_method'],
            'original_amount' => $this->toCents($data['original_value']),
            'converted_amount' => $this->toCents($data['conversion_details']['converted_amount']),
            'exchange_rate' => $this->toCents($data['conversion_details']['exchange_rate']),
            'tax_rate_value' => $this->toCents($data['tax']['tax_rate_value']),
            'tax_rate_value_porcentages' => $data['tax']['tax_rate_percentage'],
            'tax_conversion_value' => $this->toCents($data['tax']['tax_conversion_value']),
            'tax_conversion_percentage' => $data['tax']['tax_conversion_percentage'],
            'tax_total' => $this->toCents($data['tax']['total_tax']),
            'original_value_minus_tax' => $this->toCents($data['original_value'] - $data['tax']['total_tax']),
            'email_sent_at' => null,
        ];
    }

    /**
     * Create the conversion details based on the given amounts and exchange rate.
     * 
     * @param float $amountInOrigin The amount in the origin currency.
     * @param float $amountInDestination The amount in the destination currency.
     * @param float $askRate The exchange rate.
     * @return array The conversion details.
     */
    private function createConversionDetails($amountInOrigin, $amountInDestination, $askRate)
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
    private function getTaxRate($paymentMethod)
    {
        $taxConfig = $this->user->getUserConfigTax(Auth::user()->id, $paymentMethod);
        if($taxConfig && isset($taxConfig->payment_method_fee)){
            return $taxConfig->payment_method_fee;
        }
        
        if($paymentMethod == 'Boleto'){
            return 1.45;
        }
        if($paymentMethod == 'CreditCard'){
            return 7.63;
        }
        return 0;
    }

    /**
     * Get the tax conversion based on the value and payment method.
     * 
     * @param float $valueInCents The value in cents.
     * @param string $paymentMethod The payment method.
     * @return float The tax conversion.
     */
    private function getTaxConversion($valueInCents, $paymentMethod)
    {
        $taxConfig = $this->user->getUserConfigTax(Auth::user()->id, $paymentMethod);
        if($taxConfig 
            && isset($taxConfig->conversion_fee_threshold) 
            && isset($taxConfig->conversion_fee_below_threshold) 
            && isset($taxConfig->conversion_fee_above_threshold)){
            $conversionFeeThreshold = $taxConfig->conversion_fee_threshold;
            $conversionFeeBelowThreshold = $taxConfig->conversion_fee_below_threshold;
            $conversionFeeAboveThreshold = $taxConfig->conversion_fee_above_threshold;
            if($valueInCents <= $this->toCents($conversionFeeThreshold)){
                return $conversionFeeBelowThreshold;
            }
            return $conversionFeeAboveThreshold;
        }

        if($valueInCents <= $this->toCents(3000)){
            return 2;
        }
        return 1;
    }

    /**
     * Calculate the conversion details based on the given data.
     * 
     * @param array $data The data for calculating the conversion details.
     * @return array The conversion details.
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
            $amountInOrigin, $amountInDestination, $askRate
        );
        
        return $conversionDetails;
    }

    /**
     * Calculate the tax based on the given amount and tax rate.
     * 
     * @param float $amount The amount.
     * @param float $tax The tax rate.
     * @return int The calculated tax.
     */
    private function calculateTax($amount, $tax)
    {
        return (int) ($amount * $tax / 100);
    }
    
    /**
     * Convert the amount to cents.
     * 
     * @param float $amount The amount.
     * @return int The amount in cents.
     */
    private function toCents($amount)
    {
        return (int) round($amount * 1000);
    }
    
    /**
     * Convert the amount in cents to currency.
     * 
     * @param int $amountInCents The amount in cents.
     * @return float The amount in currency.
     */
    private function toCurrency($amountInCents)
    {
        return round($amountInCents / 1000.0, 3);
    }
    
    /**
     * Get the ask rate based on the given data, origin, and destination.
     * 
     * @param array $data The data.
     * @param string $origin The origin currency.
     * @param string $destination The destination currency.
     * @return float The ask rate.
     */
    private function getAskRate($data, $origin, $destination): float
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
}
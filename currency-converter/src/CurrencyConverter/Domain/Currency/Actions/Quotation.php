<?php

namespace CurrencyConverter\Domain\Currency\Actions;

use CurrencyConverter\Domain\Currency\DTOs\FormData as FormDataDTO;
use CurrencyConverter\Domain\Currency\DTOs\ListData;
use CurrencyConverter\Domain\Currency\Services\CurrencyService;

/**
 * Class Convert
 * @package CurrencyConverter\Domain\Currency\Actions
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class Quotation
{
    public function __invoke(FormDataDTO $dto)
    {
        $service = app(CurrencyService::class);
        $quotationData = $service->getQuotation($dto);

        ListData::$originCurrency = 'BRL';
        ListData::$destinyCurrency = $dto::$destinyCurrency;
        ListData::$valueConversion = number_format($dto::$valueConversion,2,',','.');
        ListData::$paymentMethod = $dto::$paymentMethod == 1 ? 'Boleto' : 'Cartão de Crédito';
        ListData::$destinationCurrencyValueForConversion = number_format($quotationData['bid'],2,',','.');
        ListData::$valuePurchasesInDestinationCurrency = number_format($this->calculateValuePurchasesInDestinationCurrency($dto::$paymentMethod, $dto::$valueConversion),2,',','.');
        ListData::$paymentRate = number_format($this->getPaymentRate($dto::$paymentMethod, $dto::$valueConversion),2,',','.');
        ListData::$conversionRate = number_format($this->getConversionRate($dto::$valueConversion),2,',','.');

        return ListData::toArray();
    }

    /**
     * @param int $paymentMethod
     * @param string $valueConversion
     * @return float|int
     */
    private function getPaymentRate(int $paymentMethod ,string $valueConversion)
    {
        if( $paymentMethod != 1 && $paymentMethod != 2 ){
            throw new \DomainException('Invalid payment method!');
        }

        if( $paymentMethod == 1 ){
            return $valueConversion * (1.45/100);
        }

        return $valueConversion * (7.63/100);
    }

    /**
     * @param string $valueConversion
     * @return float|int
     */
    private function getConversionRate(string $valueConversion) : float
    {
        if( $valueConversion < 3000 )
        {
            return $valueConversion * (2/100);
        }
        return $valueConversion * (1/100);
    }

    private function calculateValuePurchasesInDestinationCurrency(int $paymentMethod ,string $valueConversion) : float
    {
        return $valueConversion - ($this->getPaymentRate($paymentMethod, $valueConversion) + $this->getConversionRate($valueConversion));
    }
}

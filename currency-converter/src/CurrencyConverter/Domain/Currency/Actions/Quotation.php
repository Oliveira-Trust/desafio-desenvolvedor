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
    const BOLETO_RATE = 0.0145;
    const CREDIT_CARD_RATE = 0.0763;

    public function __invoke(FormDataDTO $dto)
    {
        $service = app(CurrencyService::class);
        $quotationData = $service->getQuotation($dto);

        ListData::$originCurrency = 'BRL';
        ListData::$destinyCurrency = $dto::$destinyCurrency;
        ListData::$valueConversion = $dto::$valueConversion;
        ListData::$paymentMethod = $dto::$paymentMethod == 1 ? 'Boleto' : 'Cartão de Crédito';
        ListData::$destinationCurrencyValueForConversion = $quotationData['bid'];
        ListData::$valuePurchasesInDestinationCurrency = $this->calculateValuePurchasesInDestinationCurrency($dto::$paymentMethod, $dto::$valueConversion);
        ListData::$paymentRate = $this->getPaymentRate($dto::$paymentMethod, $dto::$valueConversion);
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
     * @param int $paymentMethod
     * @param string $valueConversion
     * @return float|int
     */
    private function getConversionRate(int $paymentMethod ,string $valueConversion) : float
    {
        if( $valueConversion < 3000 )
        {
            return $valueConversion * (2/100);
        }
        return $valueConversion * (1/100);
    }

    private function calculateValuePurchasesInDestinationCurrency(int $paymentMethod ,string $valueConversion) : float
    {
        return $valueConversion - ($this->getPaymentRate($paymentMethod, $valueConversion) + $this->getConversionRate($paymentMethod, $valueConversion));
    }
}

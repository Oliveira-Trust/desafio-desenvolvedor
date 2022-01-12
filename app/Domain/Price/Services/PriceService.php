<?php

namespace App\Domain\Price\Services;

use App\Domain\Price\Services\Interfaces\PriceServiceInterface;
use App\Domain\Price\Gateways\Interfaces\PriceGatewayInterface;


class PriceService implements PriceServiceInterface {

    public function __construct(PriceGatewayInterface $priceGateway)
    {
        $this->priceGateway = $priceGateway;
    }

    public function getPriceData(string $currencyCode):?array
    {
        $priceData = $this->priceGateway->getPrice($currencyCode);

        return $priceData;
    }

    public function prepareDataForView(array $data):array
    {
        return [
            'originCurrency'       => 'BRL',
            'targetCurrency'       => $data['priceData']['code'],
            'amountToConvert'      => $data['request']['amount'],
            'paymentMethod'        => $data['paymentMethod']['name'],
            'targetCurrencyPrice'  => $data['priceData']['bid'],
            'amountBought'         => $data['amountBought'],
            'paymentFee'           => $data['paymentMethodFee'],
            'defaultServiceFee'    => $data['defaultServiceFee'],
            'amountUsedAfterTaxes' => $data['amountUsedAfterTaxes']
        ];
    }

    public function calculateAmountBought(float $priceBid, float $amountUsedAfterTaxes):float
    {
        $amountBought = $amountUsedAfterTaxes / $priceBid;

        return (float)$amountBought;
    }

}

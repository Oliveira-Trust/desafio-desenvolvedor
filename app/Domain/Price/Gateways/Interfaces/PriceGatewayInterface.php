<?php


namespace App\Domain\Price\Gateways\Interfaces;

interface PriceGatewayInterface {

    public function getPrice(string $currencyCode):array;

}

<?php

namespace App\Domain\Price\Services\Interfaces;

interface PriceServiceInterface {

    public function getPriceData(string $currencyCode):?array;

    public function prepareDataForView(array $data):array;

    public function calculateAmountBought(float $cotationData, float $amountUsedAfterTaxes):float;
}

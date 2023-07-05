<?php
namespace App\Domain\Repositories;

interface ConversionRepositoryInterface{
    public function create(string $origin_currency,  string $destination_currency, float $conversion_value, float $converted_value, string $payment_method); 

    public function getConversionHistory(int $idUser): Array;
}
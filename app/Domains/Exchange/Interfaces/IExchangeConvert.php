<?php

namespace App\Domains\Exchange\Interfaces;

use App\Domains\Exchange\DTO\ConversionResultDTO;

interface IExchangeConvert
{
    public function currencyExchange(int $currency_id_from, int $currency_id_to, string $amount): ConversionResultDTO;

}

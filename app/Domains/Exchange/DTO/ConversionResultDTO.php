<?php

namespace App\Domains\Exchange\DTO;

class ConversionResultDTO
{
    public function __construct(public string $amount_bid, public string $amount_convert_to)
    {
    }
}

<?php

namespace App\Domains\Exchange\DTO;

class ExchangeDTO
{

    public function __construct(
        public int   $user_id,
        public int   $payment_method_id,
        public int   $currency_id_from,
        public int   $currency_id_to,
        public string $amount
    )
    {
    }

}

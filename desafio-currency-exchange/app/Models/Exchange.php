<?php

declare(strict_types=1);

namespace App\Models;

class Exchange
{
    public CONST BILLING_TYPE = [
        'CREDIT_CARD' => "CARTAO DE CREDITO",
        'BANK_SLIP' => "BOLETO"
    ];

    public CONST VALUE_FOR_RATE = 3000.0;

}

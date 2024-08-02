<?php

declare(strict_types=1);

namespace Module\Broker\Enums;

enum PaymentMethod: string
{
    case CREDIT_CARD = 'credit_card';
    case BANK_SLIP = 'bank_slip';
}

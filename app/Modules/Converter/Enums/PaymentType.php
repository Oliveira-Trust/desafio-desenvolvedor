<?php

namespace Converter\Enums;

use App\Enums\Enum;

final class PaymentType extends Enum
{
    const BILLET =      1;
    const CREDIT_CARD = 2;
}
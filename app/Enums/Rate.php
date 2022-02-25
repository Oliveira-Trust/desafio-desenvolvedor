<?php

namespace App\Enums;

enum Rate: string
{
    case BANK_SLIP = '1.45';
    case CREDIT_CARD = '7.63';
    case COVERT_SMALLER = '2.00';
    case COVERT_LARGER = '1.00';
}

<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Domain: string
{
    case API = 'api';
    case DEFAULT_CURRENCY = 'BRL';
    case DEFAULT_CONVERSION_RATE = '50.00';
}

<?php

declare(strict_types=1);

namespace App\Enumerators;

enum EconomyQuotation: string
{
    case CONFIG_FILE = 'integrations';
    case ECONOMY_QUOTATION = 'economy_quotation';

    public static function getPathApiURI(): string
    {
        return self::CONFIG_FILE->value . '.' . self::ECONOMY_QUOTATION->value . '.' . Domain::API->value;
    }
}

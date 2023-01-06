<?php

namespace Modules\Exchange\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum Currency: string
{
    use InvokableCases;
    use Names;
    use Values;

    case BRL = 'BRL';
    case USD = 'USD';
    case EUR = 'EUR';

    public static function map()
    {
        return collect(Currency::values())->mapWithKeys(function ($item, $key) {
            return [$item => $item];
        })->toArray();
    }
}

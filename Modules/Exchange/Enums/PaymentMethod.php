<?php

namespace Modules\Exchange\Enums;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum PaymentMethod: string
{
    use InvokableCases;
    use Names;
    use Values;

    case BANK_SLIPS = 'bank_slips';
    case CREDIT_CARD = 'credit_card';

    public static function map()
    {
        return collect(PaymentMethod::values())->mapWithKeys(function ($item, $key) {
            return [$item => formatPaymentMethod($item)];
        })->toArray();
    }
}

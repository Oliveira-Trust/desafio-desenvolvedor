<?php

namespace App\Models\Enum;

class PaymentMethodEnum
{
    const CREDIT_CARD = 'CREDIT_CARD';
    const BANK_SLIP = 'BANK_SLIP';

    public static function fromKey(string $key = '')
    {
        switch ($key) {
            case self::CREDIT_CARD:
                return self::CREDIT_CARD;
                break;
            case self::BANK_SLIP:
                return self::BANK_SLIP;
                break;

            default:
                return self::CREDIT_CARD;
                break;
        }
    }
}

<?php

namespace App\Enum\Traits;

trait Values
{
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}

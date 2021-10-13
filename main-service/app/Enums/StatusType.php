<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static INACTIVATED()
 * @method static static ACTIVATED()
 */
final class StatusType extends Enum
{
    public const INACTIVATED = 0;
    public const ACTIVATED   = 1;
}

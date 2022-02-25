<?php

namespace App\Enums;

enum Regex: string
{
    case REGEX_CURRENCY_BRL = '/^([1-9]{1}[\d]{0,2}(\.[\d]{3})*(\,[\d]{0,2})?|[1-9]{1}[\d]{0,}(\,[\d]{0,2})?|0(\,[\d]{0,2})?|(\,[\d]{1,2})?)$/';
}

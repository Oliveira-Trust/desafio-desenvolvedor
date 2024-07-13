<?php

declare(strict_types=1);

namespace App\Enumerators;

enum Exceptions: string
{
    case NOT_FOUND = 'notFound';
    case UNAUTHORIZED = 'unauthorized';
    case TRANSLATIONS_NOT_FOUND = 'translationsNotFound';
    case COMBINATIONS_NOT_FOUND = 'combinationsNotFound';
    case QUOTATIONS_NOT_FOUND = 'quotationsNotFound';
    case OUT_OF_RANGE = 'outOfRange';
    case PAYMENT_NOT_FOUND = 'paymentNotFound';
    case ERROR_CONVERSION = 'errorConversion';
    case FIELDS_REQUIRED = 'fieldsRequired';
}

<?php

use App\Enumerators\Exceptions;

return [
    Exceptions::NOT_FOUND->value => 'Quotations not found.',
    Exceptions::TRANSLATIONS_NOT_FOUND->value => 'Translations not found.',
    Exceptions::COMBINATIONS_NOT_FOUND->value => 'Combinations not found.',
    Exceptions::QUOTATIONS_NOT_FOUND->value => 'Quotations not found.',
    Exceptions::PAYMENT_NOT_FOUND->value => 'Payment not found.',
    Exceptions::OUT_OF_RANGE->value => 'Amount out of range to convert.',
    Exceptions::ERROR_CONVERSION->value => 'Error, conversion check the values and try again.',
];

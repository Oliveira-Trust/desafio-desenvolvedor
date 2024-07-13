<?php

declare(strict_types=1);

use App\Enumerators\Domain;
use App\Enumerators\EconomyQuotation;

return [
    EconomyQuotation::ECONOMY_QUOTATION->value => [
        Domain::API->value => env('ECONOMY_API', ''),
    ],
];

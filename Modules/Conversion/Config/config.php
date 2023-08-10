<?php

use Modules\Conversion\Drivers\CurrencyExchangeAwesomeapi;

return [
    'name' => 'Conversion',

    'services' => [
        'currency_exchange' => CurrencyExchangeAwesomeapi::class,
        'timeout' => 5,
        'retry' => [
            'times' => 5,
            'sleep' => 1000
        ]
    ]
];

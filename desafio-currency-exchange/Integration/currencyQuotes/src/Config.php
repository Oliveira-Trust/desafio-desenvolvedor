<?php

declare(strict_types=1);

namespace Integration\currencyQuotes\src;

use App\Component\Enumerators\CurrencyEnumerators;

trait Config
{
    protected $config = [
        'base_url' => [
            'default_json' => 'https://economia.awesomeapi.com.br/json/'
        ],
        'requests' => [
            'last_occurrence' => [
                'method' => 'get',
                'uri' => 'last/'
            ],
            'daily_occurrence' => [
                'method' => 'get',
                'uri' => 'daily/'
            ]
        ],
        'currency' => [
            'default_currency' => CurrencyEnumerators::DEFAULT_CURRENCY
        ]
    ];
}

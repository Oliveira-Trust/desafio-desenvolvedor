<?php

return array(
    'conversion'    => [
        'value' => [
            'min' => 1000.01,
            'max' => 99999.99
        ]
    ],
    'payment_types' => [
        'min' => [
            'min' => 1,
            'max' => 10,
        ],
        'max' => [
            'min' => 1,
            'max' => 10,
        ],
        'tax' => [
            'min' => 1,
            'max' => 6,
        ]
    ],
    'conversion_taxs' => [
        'min' => [
            'min' => 0,
            'max' => 99999.99
        ],
        'max' => [
            'min' => 0,
            'max' => 99999.99
        ]
    ]
);

<?php


return [
    'connection' => 'sqlite_customer',
    'user_table' => env('CUSTOMER_USER_TABLE'),
    'guard'      => env('API_CUSTOMERS_GUARD', 'web_customers'),
    'web_guard'  => env('WEB_CUSTOMERS_GUARD', 'web_customers'),
    'blocks'     => [
        'limit_time' => 2,
    ]
];

<?php

return [
    'users'               => [
        'api_base_url' => env('USERS_API_BASE_URL', 'http://user_api/api/'),
    ],

    'exchange_rate_check' => [
        'awesome_api_url' => env('AWESOME_API_URL', 'https://economia.awesomeapi.com.br/json/'),
    ],
];

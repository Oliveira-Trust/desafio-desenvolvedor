<?php
// config/currency_api.php

return [
    'url' => env('CURRENCY_API_URL'),
    'key' => env('CURRENCY_API_KEY'),
    'base_uri' => env('CURRENCY_API_BASE_URI', 'https://api.example.com'),
    'timeout' => env('CURRENCY_API_TIMEOUT', 5.0),
];

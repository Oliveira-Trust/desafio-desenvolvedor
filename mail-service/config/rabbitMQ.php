<?php

return [
    'host' => env('RABBITMQ_HOST', 'localhost'),
    'port' => env('RABBITMQ_PORT', 5672),
    'user' => env('RABBITMQ_DEFAULT_USER', 'guest'),
    'password' => env('RABBITMQ_DEFAULT_PASS', 'guest'),
];

<?php

return [

    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users'
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users'
        ]
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Auth\Models\User::class,
        ]
    ]
];
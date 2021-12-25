<?php
require_once __DIR__ . '/../functions/env.php';

return [
    "corsAllow"=> env('CORS_PERMISSION'),
    "BASE_URL"=> env('BASE_URL'),
    "key_secret"=> env('APP_KEY'),
    "database" => [
        "driver"=> env('DRIVER'),
        "host"=> env('HOST'),
        "dbname"=> env('DBNAME'),
        "username"=> env('USERNAME'),
        "password"=> env('PASSWORD'),
        "port"=> env('PORT'),
        "charset"=> env('CHARSET'),
        "collation"=> env('COLLATION'),
        "prefix"=> env('PREFIX_DB')
    ]
];
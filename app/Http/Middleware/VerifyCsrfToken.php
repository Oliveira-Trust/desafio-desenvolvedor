<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'stripe/*',
        'http://localhost:8000/category',
        'http://localhost:8000/category/*',
        'http://localhost:8000/product',
        'http://localhost:8000/product/filter/*',
        'http://localhost:8000/product/*',
        'http://localhost:8000/product/*/sendPhoto',
        'http://localhost:8000/login',
        'http://localhost:8000/user',
        'http://localhost:8000/user/*',
        'http://localhost:8000/sale',
        'http://localhost:8000/sale/*',
        'http://localhost:8000/product_sale',
        'http://localhost:8000/product_sale/*',
        'http://localhost:3000/*',
    ];
}

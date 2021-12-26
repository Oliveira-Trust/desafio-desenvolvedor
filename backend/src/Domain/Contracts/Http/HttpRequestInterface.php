<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Http;


interface HttpRequestInterface
{
    public function __construct(array $data);
    public function request(string $params = '', string $method = 'GET');
}
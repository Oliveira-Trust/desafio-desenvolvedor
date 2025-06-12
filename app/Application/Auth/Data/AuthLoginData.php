<?php

namespace Application\Auth\Data;

use Spatie\LaravelData\Data;

class AuthLoginData extends Data {
    public function __construct(public string $email, public string $password)
    {
    }
}

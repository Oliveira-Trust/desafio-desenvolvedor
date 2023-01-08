<?php

namespace App\DTO\Entities;

use Spatie\LaravelData\Data;

class UserEntityData extends Data {
    public function __construct(
        public int $id,
        public string $name,
        public string $email
    ) {

    }
}

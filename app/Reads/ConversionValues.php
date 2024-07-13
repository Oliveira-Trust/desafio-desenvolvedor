<?php

declare(strict_types=1);

namespace App\Reads;

readonly class ConversionValues implements ConversionValuesInterface
{
    public function __construct(
        private array $attributes
    ) {
    }

    public function from(): string
    {
        return $this->attributes['from'] ?? '';
    }

    public function to(): string
    {
        return $this->attributes['to'] ?? '';
    }

    public function payment(): string
    {
        return $this->attributes['payment'] ?? '';
    }

    public function amount(): int
    {
        return $this->attributes['amount'] ?? 0;
    }

    public function currencies(): string
    {
        return "{$this->from()}-{$this->to()}";
    }
}

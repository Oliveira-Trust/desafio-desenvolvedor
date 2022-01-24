<?php

declare(strict_types=1);

namespace AwesomeApi\Adapters;

class CurrencyAdapter
{
    private ?string $code;
    private ?string $codeIn;
    private ?string $name;
    private ?string $bid;
    private ?string $createDate;

    public function __construct(array $attributes)
    {
        $attributes = array_values($attributes);
        $this->code = $attributes[0]['code'] ?? null;
        $this->codeIn = $attributes[0]['codein'] ?? null;
        $this->name = $attributes[0]['name'] ?? null;
        $this->bid = $attributes[0]['bid'] ?? null;
        $this->createDate = $attributes[0]['create_date'] ?? null;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function getCodeIn(): ?string
    {
        return $this->codeIn;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getBid(): ?float
    {
        return (float) ($this->bid ?? 0);
    }

    public function getCreateDate(): ?string
    {
        return $this->createDate;
    }
}

<?php

declare(strict_types=1);

namespace AwesomeApi\Models;

use AwesomeApi\Adapters\CurrencyAdapter;

class Currency
{
    private ?string $code;
    private ?string $codeIn;
    private ?string $name;
    private ?int $bid;
    private ?string $createDate;

    public function __construct(CurrencyAdapter $currencyAdapter)
    {
        $this->code = $currencyAdapter->getCode();
        $this->codeIn = $currencyAdapter->getCodeIn();
        $this->name = $currencyAdapter->getName();
        $this->bid = $currencyAdapter->getBid();
        $this->createDate = $currencyAdapter->getCreateDate();
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

    public function getBid(): ?int
    {
        return $this->bid;
    }

    public function getCreateDate(): ?string
    {
        return $this->createDate;
    }
}

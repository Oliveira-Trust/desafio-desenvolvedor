<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Shared;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class BaseEntity
{
    protected UuidInterface $_ID;

    public function __construct(string $uuid = '')
    {
        $this->_ID = (empty($uuid)) ? Uuid::uuid4() : Uuid::fromString($uuid);
    }

    public function getID(): UuidInterface
    {
        return $this->_ID;
    }
}

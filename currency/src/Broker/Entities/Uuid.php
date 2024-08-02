<?php

declare(strict_types=1);

namespace Module\Broker\Entities;

use Ramsey\Uuid\Uuid as RamseyUuid;

final readonly class Uuid
{
    public function __construct(
        public string $value
    ) {
        $this->isValid($this->value);
    }

    private function isValid(string $id): void
    {
        if (! RamseyUuid::isValid($id)) {
            throw new \InvalidArgumentException(sprintf('<%s> does not allow the value <%s>', self::class, $id));
        }
    }

    public static function generate(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }
}

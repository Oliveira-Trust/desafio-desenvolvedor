<?php

declare(strict_types=1);

namespace OT\ConversorMoedas\Domain\Shared;

use Illuminate\Support\Collection;
use OT\ConversorMoedas\Domain\Shared\BaseEntity;

interface IBaseRepository
{
    public function fetchAll(): Collection;
    public function findByID(string $ID): BaseEntity;
}

<?php

declare(strict_types=1);

namespace App\Domain\Contracts\Repository;

use App\Domain\Entities\Currency;

interface CurrencyRepositoryInterface
{
    public function getById(int $id):? Currency;
    public function getAll(): array;
    public function getByCurrencyCode(string $code):? Currency;
    public function save(Currency $currency): Currency;
}
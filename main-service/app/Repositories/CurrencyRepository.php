<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Currency;
use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyRepository extends BaseRepository implements CurrencyRepositoryInterface
{
    public function model() : string
    {
        return Currency::class;
    }
}

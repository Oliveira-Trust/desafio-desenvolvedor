<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\CurrencyRepositoryInterface;

class CurrencyRepository extends AbstractRepository implements CurrencyRepositoryInterface
{
    protected $model = Currency::class;
}

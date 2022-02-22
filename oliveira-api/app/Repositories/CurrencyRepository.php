<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Abstracts\AbstractBaseRepository as BaseRepository;

class CurrencyRepository extends BaseRepository
{
    public function __construct()
    {
        $this->setModel(Currency::class);
    }
}

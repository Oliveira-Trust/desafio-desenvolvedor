<?php

namespace App\Repositories;

use App\Models\CurrencyExchangeHistoric;
use Prettus\Repository\Eloquent\BaseRepository;

class CurrencyExchangeHistoricRepository extends BaseRepository
{
    public function model()
    {
        return CurrencyExchangeHistoric::class;
    }
}

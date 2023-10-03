<?php

namespace App\Repositories;

use App\Models\CurrencyExchangeSetting;
use Prettus\Repository\Eloquent\BaseRepository;

class CurrencyExchangeSettingRepository extends BaseRepository
{
    public function model()
    {
        return CurrencyExchangeSetting::class;
    }
}

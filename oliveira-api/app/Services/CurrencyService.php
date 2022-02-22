<?php

namespace App\Services;

use App\Repositories\CurrencyRepository;
use App\Abstracts\AbstractBaseService as BaseService;

class CurrencyService extends BaseService
{
    public function __construct(CurrencyRepository $currencyRepository)
    {
        parent::__construct($currencyRepository);
    }
}

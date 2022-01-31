<?php

namespace App\Repositories\Customer;

use App\Abstracts\BaseRepository;
use App\EloquentModels\Customer\CustomerExchange;

class CustomerExchangeRepository extends BaseRepository
{

    public function model()
    {
        return CustomerExchange::class;
    }

}

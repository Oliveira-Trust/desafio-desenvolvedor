<?php

namespace App\Repositories\Customer;

use App\Abstracts\BaseRepository;
use App\EloquentModels\Admin\TaxInterval;

class TaxIntervalRepository extends BaseRepository
{

    public function model()
    {
        return TaxInterval::class;
    }

}

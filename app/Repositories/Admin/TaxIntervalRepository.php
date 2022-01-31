<?php

namespace App\Repositories\Admin;

use App\Abstracts\BaseRepository;
use App\EloquentModels\Admin\TaxInterval;

class TaxIntervalRepository extends BaseRepository
{

    public function model()
    {
        return TaxInterval::class;
    }

}

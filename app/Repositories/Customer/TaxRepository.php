<?php

namespace App\Repositories\Customer;

use App\Abstracts\BaseRepository;
use App\EloquentModels\Admin\Tax;

class TaxRepository extends BaseRepository
{

    public function model()
    {
        return Tax::class;
    }

}

<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ConvertedValueRepository
{


    /**
     * Create a converted value.
     *
     * @param array $data
     * @return Model|null
     */
    public function createConvertedValue(array $data) :? Model;

    /**
     * Create a converted value.
     *
     * @param array $data
     * @return Model|null
     */
    public function updateConvertedValue(array $data, $id) :? Model;
}

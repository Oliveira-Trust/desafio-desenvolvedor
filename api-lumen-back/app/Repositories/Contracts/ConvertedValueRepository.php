<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ConvertedValueRepository
{
    /**
     * Get a value by tenant
     *
     * @return Model|null
     */
    public function getValueConvetedByTenant(int $tenant) :? Model;

    /**
     * Get all values by tenant
     *
     * @return Collection|null
     */
    public function getAllValueConvetedByTenant(int $tenant) :? Collection;

    /**
     * Create a converted value.
     *
     * @param array $data
     * @return Model|null
     */
    public function createConvertedValue(array $data) :? Model;
}

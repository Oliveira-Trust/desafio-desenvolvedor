<?php

namespace App\Repositories;

use App\Repositories\Contracts\ConvertedValueRepository;
use App\Traits\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ConvertedValueRepositoryImplementation implements ConvertedValueRepository
{
    use BaseEloquentRepository;

    /**
     * Get a value by tenant
     *
     * @return Model|null
     */
    public function getValueConvetedByTenant(int $tenant) :? Model
    {
        return $this->where(['tenant_id' => $tenant])->first();
    }

    /**
     * Get all values by tenant
     *
     * @return Collection|null
     */
    public function getAllValueConvetedByTenant(int $tenant) :? Collection
    {
        return $this->where(['tenant_id' => $tenant])->get();
    }

    /**
     * Create a converted value.
     *
     * @param array $data
     * @return Model|null
     */
    public function createConvertedValue(array $data) :? Model
    {
        return $this->create($data);
    }
}

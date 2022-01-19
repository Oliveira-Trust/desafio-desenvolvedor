<?php

namespace App\Repositories;

use App\Repositories\Contracts\TenantRepository;
use App\Traits\BaseEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class TenantRepositoryImplementation implements TenantRepository
{
    use BaseEloquentRepository;

    /**
     * Get a tenant.
     *
     * @param string $subdomain
     * @return Model|null
     */
    public function getTenant(string $subdomain) :? Model
    {
        return $this->where(['subdomain' => $subdomain])->first();
    }

    /**
     * Get all tenants.
     *
     * @return Collection|null
     */
    public function getTenants() :? Collection
    {
        return $this->getAll();
    }
}

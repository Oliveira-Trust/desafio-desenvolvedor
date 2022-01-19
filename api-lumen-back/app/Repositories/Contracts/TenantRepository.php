<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface TenantRepository
{
    /**
     * Get a tenant.
     *
     * @param string $subdomain
     * @return Model|null
     */
    public function getTenant(string $subdomain) :? Model;

    /**
     * Get all tenants.
     *
     * @return Collection|null
     */
    public function getTenants() :? Collection;
}

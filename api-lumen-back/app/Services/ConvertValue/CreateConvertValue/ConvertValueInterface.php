<?php

namespace App\Services\ConvertValue\CreateConvertValue;

use App\Models\ConvertedValue;
use App\Models\Tenant;
use App\Repositories\Contracts\ConvertedValueRepository;

interface ConvertValueInterface
{
    /**
     * Set parameters.
     *
     * @param array $params
     * @return ConvertValueInterface
     */
    public function setParams(array $params) : ConvertValueInterface;

    /**
     * Set a tenant.
     *
     * @param Tenant $tenant
     * @return ConvertValueInterface
     */
    public function setTenant(Tenant $tenant) : ConvertValueInterface;

    /**
     * Set repository Convert Value.
     *
     * @param ConvertedValueRepository $convertedValueRepository
     * @return ConvertValueInterface
     */
    public function setConvertValueRepository(ConvertedValueRepository $convertedValueRepository): ConvertValueInterface;

    /**
     * Handle.
     *
     * @return ConvertedValue|null
     */
    public function handle() :? ConvertedValue;
}

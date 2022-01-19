<?php

namespace App\Services\ConvertValue\CreateConvertValue;

use App\Models\Tenant;
use App\Repositories\Contracts\ConvertedValueRepository;

abstract class ConvertValueBase implements ConvertValueInterface
{
    protected $tenant;

    protected $params;

    protected ConvertedValueRepository $convertedValueRepository;

    public function setTenant(Tenant $tenant): ConvertValueInterface
    {
        $this->tenant = $tenant;
        return $this;
    }

    public function setParams(array $params): ConvertValueInterface
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Set repository Convert Value.
     *
     * @param ConvertedValueRepository $convertedValueRepository
     * @return ConvertValueInterface
     */
    public function setConvertValueRepository(ConvertedValueRepository $convertedValueRepository): ConvertValueInterface
    {
        $this->convertedValueRepository = $convertedValueRepository;
        return $this;
    }
}

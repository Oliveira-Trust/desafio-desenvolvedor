<?php

namespace App\Services\ConvertValue;

use App\Models\User;
use App\Repositories\Contracts\ConvertedValueRepository;

abstract class ConvertValueBase implements ConvertValueInterface
{
    protected $User;

    protected $params;

    protected ConvertedValueRepository $convertedValueRepository;



    public function setParams(array $params): ConvertValueInterface
    {
        $this->params = $params;
        return $this;
    }

    public function setId(int $id): ConvertValueInterface
    {
        $this->id = $id;
        return $this;
    }

    public function setUser(User $User): ConvertValueInterface
    {
        $this->User = $User;
        return $this;
    }

    
    public function setConvertValueRepository(ConvertedValueRepository $convertedValueRepository): ConvertValueInterface
    {
        $this->convertedValueRepository = $convertedValueRepository;
        return $this;
    }
}

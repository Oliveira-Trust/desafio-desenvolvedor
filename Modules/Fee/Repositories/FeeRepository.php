<?php

namespace Modules\Fee\Repositories;

use Modules\Fee\Entities\Fee;
use Modules\Fee\Repositories\Contracts\FeeRepositoryInterface;

class FeeRepository implements FeeRepositoryInterface
{
    private $model;

    public function __construct(Fee $fee)
    {
        $this->model = $fee;
    }

    public function getFeeValueByColumnName(string $columnName): float
    {
        return $this->model->first()->$columnName;
    }

    public function getFees(): Fee
    {
        return $this->model->first();
    }

    public function update(array $data): void
    {
        $fees = $this->getFees();
        $fees->update($data);
    }
}

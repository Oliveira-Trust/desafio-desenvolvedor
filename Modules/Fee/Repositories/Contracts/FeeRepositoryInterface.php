<?php

namespace Modules\Fee\Repositories\Contracts;

use Modules\Fee\Entities\Fee;

interface FeeRepositoryInterface
{
    /**
     * @param string $columnName
     * @return float
     */
    public function getFeeValueByColumnName(string $columnName): float;

    /**
     * @return Fee
     */
    public function getFees(): Fee;

    /**
     * @param array $data
     * @return void
     */
    public function update(array $data): void;
}

<?php

namespace Modules\Fee\Repositories\Contracts;

interface FeeRepositoryInterface
{
    /**
     * @param string $columnName
     * @return float
     */
    public function getFeeValueByColumnName(string $columnName): float;
}

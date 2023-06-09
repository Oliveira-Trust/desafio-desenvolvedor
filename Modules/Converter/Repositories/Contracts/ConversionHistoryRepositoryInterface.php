<?php

namespace Modules\Converter\Repositories\Contracts;

use Modules\Converter\Entities\ConversionHistory;

interface ConversionHistoryRepositoryInterface
{
    /**
     * @param array $data
     * @return ConversionHistory
     */
    public function store(array $data): ConversionHistory;

    /**
     * @param integer $id
     * @return ConversionHistory
     */
    public function getById(int $id): ConversionHistory;
}

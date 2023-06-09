<?php

namespace Modules\Converter\Repositories\Contracts;

use Illuminate\Support\Collection;
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

    /**
     * @param integer $userId
     * @return Collection
     */
    public function getAllByUserId(int $userId): Collection;
}

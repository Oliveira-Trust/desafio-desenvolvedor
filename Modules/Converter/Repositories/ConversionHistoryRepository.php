<?php

namespace Modules\Converter\Repositories;

use Illuminate\Support\Collection;
use Modules\Converter\Entities\ConversionHistory;
use Modules\Converter\Repositories\Contracts\ConversionHistoryRepositoryInterface;

class ConversionHistoryRepository implements ConversionHistoryRepositoryInterface
{
    private $model;

    public function __construct(ConversionHistory $conversionHistory)
    {
        $this->model = $conversionHistory;
    }

    public function store(array $data): ConversionHistory
    {
        return $this->model->create($data);
    }

    public function getById(int $id): ConversionHistory
    {
        return $this->model->findOrFail($id);
    }

    public function getAllByUserId(int $userId): Collection
    {
        return $this->model->where('user_id', $userId)->get();
    }
}

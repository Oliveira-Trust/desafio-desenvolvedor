<?php

namespace App\Repositories\ConversionFee;

use App\Models\ConversionFee;
use App\Repositories\BaseRepository;
use App\Repositories\ConversionFee\ConversionFeeRepositoryContract;

class ConversionFeeRepository extends BaseRepository implements ConversionFeeRepositoryContract
{
    protected $model;

    public function __construct(ConversionFee $conversionFee)
    {
        $this->model = $conversionFee;
    }

    public function getById(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function all()
    {
        return $this->model->all();
    }

    public function getByAttribute(string $field, string $attribute)
    {
        return $this->model->where($field, $attribute);
    }

    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function updateById(array $data, int $id)
    {
        return $this->model->where('id', $id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->model->where('id', $id)
            ->delete();
    }

    public function getByReferenceValue($value)
    {
        return  $this->model->orderBy('created_at', 'desc')
            ->first();
    }
}

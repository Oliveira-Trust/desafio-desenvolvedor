<?php

namespace App\Repositories\CurrencyConversion;

use App\Models\CurrencyConversion;
use App\Repositories\BaseRepository;
use App\Repositories\CurrencyConversion\CurrencyConversionRepositoryContract;

class CurrencyConversionRepository extends BaseRepository implements CurrencyConversionRepositoryContract
{
    protected $model;

    public function __construct(CurrencyConversion $currencyConversion)
    {
        $this->model = $currencyConversion;
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

    public function getByUserId(int $userId, int $perPage, string $orderBy, string $orderDirection)
    {
        return $this->model->where('user_id', $userId)->orderBY($orderBy, $orderDirection)->paginate(($perPage));
    }
}

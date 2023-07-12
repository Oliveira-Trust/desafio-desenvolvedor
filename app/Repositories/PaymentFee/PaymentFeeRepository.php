<?php

namespace App\Repositories\PaymentFee;

use App\Models\PaymentFee;
use App\Repositories\BaseRepository;
use App\Repositories\PaymentFee\PaymentFeeRepositoryContract;

class PaymentFeeRepository extends BaseRepository implements PaymentFeeRepositoryContract
{
    protected $model;

    public function __construct(PaymentFee $paymentFee)
    {
        $this->model = $paymentFee;
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

    public function getByType(int $type)
    {
        return  $this->model->where('type', $type)
            ->orderByDesc('created_at')
            ->first();
    }
}

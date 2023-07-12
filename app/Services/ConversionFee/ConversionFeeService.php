<?php

namespace App\Services\ConversionFee;

use App\Services\ConversionFee\ConversionFeeServiceContract;
use App\Repositories\ConversionFee\ConversionFeeRepositoryContract;

class ConversionFeeService implements ConversionFeeServiceContract
{
    protected $conversionFeeRepository;

    public function __construct(ConversionFeeRepositoryContract $conversionFeeRepository)
    {
        $this->conversionFeeRepository = $conversionFeeRepository;
    }

    public function getById(int $id)
    {
        return $this->conversionFeeRepository->getById($id);
    }

    public function all()
    {
        return $this->conversionFeeRepository->all();
    }

    public function getByAttribute(string $field, string $attribute)
    {
        return $this->conversionFeeRepository->getByAttribute($field, $attribute);
    }

    public function store(array $data)
    {
        return $this->conversionFeeRepository->store($data);
    }

    public function updateById(array $data, int $id)
    {
        return $this->conversionFeeRepository->updateById($data, $id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->conversionFeeRepository->delete($id)
            ->delete();
    }

    public function getByReferenceValue($value)
    {
        
        return $this->conversionFeeRepository->getByReferenceValue($value);
    }

    public function calculateConversionFee($value)
    {
        $lastConversionFee = $this->getByReferenceValue($value);
        $conversionFee = $value >= $lastConversionFee->reference_value ? $lastConversionFee->fee_lower_value : $lastConversionFee->fee_higher_value;
        
        return $value / 100 * $conversionFee;
    }

    
}

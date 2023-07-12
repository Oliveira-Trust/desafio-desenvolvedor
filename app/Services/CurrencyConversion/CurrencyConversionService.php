<?php

namespace App\Services\CurrencyConversion;

use App\Services\CurrencyConversion\CurrencyConversionServiceContract;
use App\Repositories\CurrencyConversion\CurrencyConversionRepositoryContract;
use App\Services\ApiExternal\aweSomeApiService;
use App\Services\ConversionFee\ConversionFeeService;
use App\Services\PaymentFee\PaymentFeeService;

class CurrencyConversionService implements CurrencyConversionServiceContract
{
    protected $currencyConversionRepository;
    protected $paymentFeeService;
    protected $conversionFeeService;
    protected $aweSomeApiService;

    public function __construct(
        CurrencyConversionRepositoryContract $currencyConversionRepository,
        PaymentFeeService $paymentFeeService,
        ConversionFeeService $conversionFeeService,
        aweSomeApiService $aweSomeApiService
    ) {
        $this->currencyConversionRepository = $currencyConversionRepository;
        $this->paymentFeeService = $paymentFeeService;
        $this->conversionFeeService = $conversionFeeService;
        $this->aweSomeApiService = $aweSomeApiService;
    }


    public function getById(int $id)
    {
        return $this->currencyConversionRepository->getById($id);
    }

    public function all()
    {
        return $this->currencyConversionRepository->all();
    }

    public function getByAttribute(string $field, string $attribute)
    {
        return $this->currencyConversionRepository->getByAttribute($field, $attribute);
    }

    public function store(array $data)
    {
 
     return  $this->currencyConversionRepository->store($data);
    }

    public function updateById(array $data, int $id)
    {
        return $this->currencyConversionRepository->updateById($data, $id)
            ->update($data);
    }

    public function delete(int $id)
    {
        return $this->currencyConversionRepository->delete($id)
            ->delete();
    }

    public function applyPaymentFee($value, $type)
    {
        $paymentFee = $this->paymentFeeService->calculatePaymentFee($value, $type);
        
        $valueApplyPaymentFee = $value + $paymentFee;

        return $valueApplyPaymentFee;
    }

    public function applyConversionFee($value)
    {
        $valueApplyConversionFee = $value + $this->conversionFeeService->calculateConversionFee($value);
        
        return  $valueApplyConversionFee;
    }

    public function getValueTargetCurrency($sourceCurrency, $targetCurrency)
    {
        $resultConversionData = $this->aweSomeApiService->CurrencyConversionData($sourceCurrency,  $targetCurrency);

        return $resultConversionData['bid'];
    }

    public function getPurchasedValue($params)
    {
        return ($params['conversionValue'] - ($params['valueConversionFee'] + $params['valuePaymentFee'])) / $params['valueTargetCurrency'];
    }

    public function getValueConversionDeductiongFee($params)
    {

        return ($params['conversionValue'] - ($params['valueConversionFee'] + $params['valuePaymentFee']));
    }

    public function getByUserId(int $userId, int $perPage, string $orderBy, string $orderDirection)
    {

        return $this->currencyConversionRepository->getByUserId($userId, $perPage, $orderBy, $orderDirection);
    } 

 }

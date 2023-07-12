<?php

namespace App\Services\CurrencyConversion;

interface CurrencyConversionServiceContract
{
    public function getById(int $id);
    public function all();
    public function getByAttribute(string $field, string $attribute);
    public function store(array $data);
    public function updateById(array $data, int $id);
    public function delete(int $id);
    public function applyPaymentFee($value, $type);
    public function getValueTargetCurrency($sourceCurrency, $targetCurrency);
    public function getPurchasedValue($params);
    public function getValueConversionDeductiongFee($params);
    public function getByUserId(int $userId, int $perPage, string $orderBy, string $orderDirection);
}

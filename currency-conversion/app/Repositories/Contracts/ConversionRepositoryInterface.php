<?php

namespace App\Repositories\Contracts;

interface ConversionRepositoryInterface
{
    public function convert(array $conversionData);
    public function getCurrencyDescriptionList();
}
<?php

namespace App\Reads;

interface ConversionValuesInterface
{
    public function from(): string;
    public function to(): string;
    public function payment(): string;
    public function amount(): int;
}

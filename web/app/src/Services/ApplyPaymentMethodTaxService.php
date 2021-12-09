<?php

namespace App\Services;

use Exception;

final class ApplyPaymentMethodTaxService
{
    private mixed $convert;
    private mixed $value;
    private float $tax;

    public function withConvert(array $convert): self
    {
        $this->convert = $convert;
        return $this;
    }


    public function withTax(float $tax): self
    {
        $this->tax = $tax;
        return $this;
    }

    public function withValue(mixed $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function apply(): array
    {
        try {
            $this->convert['tax']['payment'] = ($this->value * $this->tax) / 100;

            return $this->convert;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

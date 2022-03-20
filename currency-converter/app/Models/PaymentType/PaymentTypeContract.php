<?php

namespace App\Models\PaymentType;

interface PaymentTypeContract {
    public function getTax(): float;
    public function getReadableName(): string;
    public function getSlug(): string;
}
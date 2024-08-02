<?php

namespace Module\Broker\Entities;

interface FeePaymentInterface
{
    public function calculate(Invoice $invoice): int;
}

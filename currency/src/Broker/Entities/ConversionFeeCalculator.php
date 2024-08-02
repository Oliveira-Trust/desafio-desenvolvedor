<?php

namespace Module\Broker\Entities;

abstract class ConversionFeeCalculator
{
    public function __construct(
        protected readonly ?ConversionFeeCalculator $next
    ) {}

    abstract public function apply(Invoice $invoice): int;
}

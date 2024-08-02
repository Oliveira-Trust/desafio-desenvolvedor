<?php

declare(strict_types=1);

namespace Module\Broker\Exceptions;

final class CurrencyAmountException extends \Exception
{
    public function __construct(
        protected $message = 'Currency amount exception'
    ) {
        parent::__construct($this->message);
    }
}

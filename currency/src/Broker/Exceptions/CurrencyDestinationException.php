<?php

namespace Module\Broker\Exceptions;

final class CurrencyDestinationException extends \Exception
{
    public function __construct(protected $message = 'Invalid currency destination')
    {
        parent::__construct($this->message);
    }
}

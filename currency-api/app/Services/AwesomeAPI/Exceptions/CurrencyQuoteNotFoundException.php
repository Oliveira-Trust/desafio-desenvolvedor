<?php

namespace App\Services\AwesomeAPI\Exceptions;

class CurrencyQuoteNotFoundException extends \Exception
{
    public function __construct(string $from, string $to, int $code = 0, \Exception $previous = null)
    {
        $message = "Currency quote from '{$from}' to '{$to}' not found in the API response.";
        parent::__construct($message, $code, $previous);
    }
}

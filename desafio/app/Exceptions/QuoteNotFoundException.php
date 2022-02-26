<?php

namespace App\Exceptions;

class QuoteNotFoundException extends \Exception
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message, int $code = 200)
    {
        parent::__construct($message, $code);
    }
}
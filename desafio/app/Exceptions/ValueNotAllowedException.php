<?php

namespace App\Exceptions;

class ValueNotAllowedException extends \Exception
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
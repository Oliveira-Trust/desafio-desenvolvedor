<?php
namespace App\Exceptions;

use Throwable;

class ValidatorException extends \Exception
{
    public array $errors;

    public function __construct(array $errors, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->errors = $errors;
    }
}

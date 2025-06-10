<?php

namespace Domain\Files\Exceptions;

use Exception;
use Shared\Enums\HttpStatus;

class FileAlreadyExistsException extends Exception {
    public function __construct(
        private string $filename,
        private int $statusCode = HttpStatus::BadRequest
    )
    {
        $this->message = 'The file '.$this->filename.' already exists';
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }
}

<?php

namespace Domain\Files\Exceptions;

use Exception;
use Shared\Enums\HttpStatus;

class FileAlreadyExistsException extends Exception {
    public function __construct(
        private string $filename,
        private HttpStatus $statusCode = HttpStatus::BadRequest,
    )
    {
        parent::__construct('The file '.$this->filename.' already exists');
    }

    public function getStatusCode() {
        return $this->statusCode->value;
    }
}

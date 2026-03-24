<?php

namespace App\Domains\Upload\Exceptions;

use App\Shared\Errors\DomainException;
use App\Shared\Errors\ErrorCode;

final class DuplicateUploadException extends DomainException
{
    public function __construct()
    {
        parent::__construct(
            errorCode: ErrorCode::UPLOAD_DUPLICATE_FILE,
            httpStatus: 409,
            contextErrors: null,
            message: 'Não é possível enviar o mesmo arquivo duas vezes.'
        );
    }
}

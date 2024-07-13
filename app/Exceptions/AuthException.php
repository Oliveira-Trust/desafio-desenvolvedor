<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class AuthException extends BuildException
{
    public static function unauthorized(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::UNAUTHORIZED->value,
                'message' => __('auth.' . Exceptions::UNAUTHORIZED->value),
                'httpCode' => Response::HTTP_UNAUTHORIZED,
            ]
        );
    }
}

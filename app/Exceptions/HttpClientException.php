<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class HttpClientException extends BuildException
{
    public static function translationsNotFound(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::TRANSLATIONS_NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::TRANSLATIONS_NOT_FOUND->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
            ]
        );
    }

    public static function combinationsNotFound(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::COMBINATIONS_NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::COMBINATIONS_NOT_FOUND->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
            ]
        );
    }

    public static function quotationsNotFound(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::QUOTATIONS_NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::QUOTATIONS_NOT_FOUND->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
            ]
        );
    }
}

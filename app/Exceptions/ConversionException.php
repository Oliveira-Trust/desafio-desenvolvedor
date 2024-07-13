<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enumerators\Exceptions;
use Illuminate\Http\Response;

class ConversionException extends BuildException
{
    public static function outOfRange(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::OUT_OF_RANGE->value,
                'message' => __('exceptions.' . Exceptions::OUT_OF_RANGE->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
            ]
        );
    }

    public static function paymentNotFound(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::PAYMENT_NOT_FOUND->value,
                'message' => __('exceptions.' . Exceptions::PAYMENT_NOT_FOUND->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
            ]
        );
    }

    public static function errorConversion(): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::ERROR_CONVERSION->value,
                'message' => __('exceptions.' . Exceptions::ERROR_CONVERSION->value),
                'httpCode' => Response::HTTP_NOT_FOUND,
            ]
        );
    }

    public static function fieldsRequired(string $message): BuildException
    {
        return new BuildException(
            [
                'shortMessage' => Exceptions::FIELDS_REQUIRED->value,
                'message' => $message,
                'httpCode' => Response::HTTP_UNPROCESSABLE_ENTITY,
            ]
        );
    }
}

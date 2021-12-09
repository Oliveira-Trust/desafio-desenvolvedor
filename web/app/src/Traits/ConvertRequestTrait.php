<?php

namespace App\Traits;

use ConvertModel;
use PaymentModel;
use CurrencyCodesModel;
use App\Exceptions\PaymentException;
use App\Exceptions\ConvertCodeException;
use App\Exceptions\ValueOutOfRangeException;
use App\Exceptions\InvalidUserException;

trait ConvertRequestTrait
{
    public function throwErrorForRequestedValue(float $value): void
    {
        if ($value < ConvertModel::MIN_VALUE_CONSTRAINT || $value > ConvertModel::MAX_VALUE_CONSTRAINT) {
            throw new ValueOutOfRangeException();
        }
    }

    public function throwErrorForRequestedUser(int $user): void
    {
        if ($user < 1) {
            throw new InvalidUserException();
        }
    }

    public function throwErrorForRequestedCode(string $code): void
    {
        if (false === (new CurrencyCodesModel)->isValidCode($code)) {
            throw new ConvertCodeException();
        };
    }

    public function throwErrorForRequestedPayment(int $payment): void
    {
        if (false == (new PaymentModel)->isValidPayment($payment)) {
            throw new PaymentException();
        };
    }
}

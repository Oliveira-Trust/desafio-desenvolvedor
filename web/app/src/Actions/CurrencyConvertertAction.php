<?php

namespace App\Actions;

use Exception;
use Selene\Request\Request;
use App\Traits\ConvertRequestTrait;
use App\Tasks\CurrencyConvertertTask;
use App\Tasks\ApplyPaymentMethodTaxTask;
use App\Tasks\ApplyCurrencyConvertertTaxTask;
use App\Tasks\ProcessOrderTask;
use App\Tasks\SaveOrderTask;
use App\Exceptions\CurrencyConverterGeneralException;

class CurrencyConvertertAction
{
    use ConvertRequestTrait;

    public function run(Request $request): array
    {
        try {
            $data = $request->sanitize([
                'user',
                'code',
                'value',
                'payment',
                'email',
            ]);

            if (empty($data)) {
                throw new CurrencyConverterGeneralException();
            }

            $user = (int) $data['user'] ?? 0;
            $code = (string) $data['code'] ?? '';
            $value = (float) $data['value'] ?? 0;
            $payment = (int) $data['payment'] ?? null;

            $this->throwErrorForRequestedUser($user);
            $this->throwErrorForRequestedValue($value);
            $this->throwErrorForRequestedCode($code);
            $this->throwErrorForRequestedPayment($payment);

            $convert = (new CurrencyConvertertTask)->run($code, $value);
            $convert = (new ApplyCurrencyConvertertTaxTask)->run($convert, $value);
            $convert = (new ApplyPaymentMethodTaxTask)->run($convert, $value, $payment);
            $convert = (new ProcessOrderTask)->run($convert, $value);
            $convert = (new SaveOrderTask)->run($convert, $payment, $user);

            return $convert;
        } catch (Exception $e) {
            throw $e;
        }
    }
}

<?php

namespace Modules\Conversion\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Modules\Conversion\Exceptions\ConversionException;
use Modules\Conversion\Models\Conversion;
use Modules\Conversion\Models\ConversionTax;
use Modules\Conversion\Models\CurrencyType;
use Modules\Conversion\Models\PaymentType;
use Modules\Conversion\Notifications\ConversionNotification;

class ConversionService {

    /**
     * @throws ConversionException
     */
    public function create(string $currencyOrigin, string $currencyDestiny, int $value, int $paymentTypeId): Conversion {
        $this->validate([
            'currencyOrigin'  => $currencyOrigin,
            'currencyDestiny' => $currencyDestiny,
            'value'           => int_to_float($value),
            'paymentTypeId'   => $paymentTypeId
        ]);
        $paymentType = $this->getPaymentType($paymentTypeId);
        $paymentTax = $this->getPaymentTax($value, $paymentType);
        $conversionTax = $this->getConversionTax($value);

        $currencyOriginValueWithTax = $this->getCurrencyOriginValueWithTax($value, $paymentTax, $conversionTax);
        $currencyDestinyConversion = CurrencyExchangeService::get($currencyOrigin, $currencyDestiny);
        $currencyDestinyValue = $this->getCurrencyDestinyValue($currencyOriginValueWithTax, $currencyDestinyConversion);

        $conversion = Conversion::create([
            'currency_origin_name'           => $currencyOrigin,
            'currency_origin_symbol'         => CurrencyType::where('name', $currencyOrigin)->value('symbol'),
            'currency_destiny_name'          => $currencyDestiny,
            'currency_destiny_symbol'        => CurrencyType::where('name', $currencyDestiny)->value('symbol'),
            'payment_type'                   => $paymentType->name,
            'currency_origin_value'          => $value,
            'currency_origin_value_with_tax' => $currencyOriginValueWithTax,
            'currency_destiny_value'         => $currencyDestinyValue,
            'payment_tax'                    => $paymentTax,
            'conversion_tax'                 => $conversionTax,
            'currency_destiny_conversion'    => set_money_format($currencyDestinyConversion)
        ]);

        $this->sendEmailNotification($conversion);

        return $conversion;
    }

    private function validate(array $data): void {
        $validator = Validator::make($data, [
            'currencyOrigin'  => ['exists:currency_types,name'],
            'currencyDestiny' => ['exists:currency_types,name', 'different:currencyOrigin'],
            'value'           => ['numeric', 'between:' . fieldDigits('conversion.value')],
            'paymentTypeId'   => ['exists:payment_types,id']
        ]);

        $validator->validate();
    }

    private function sendEmailNotification(Conversion $conversion): void {
        Notification::send(Auth::user(), new ConversionNotification($conversion));
    }

    private function getConversionTax(int $value): int {
        $conversionTax = ConversionTax::search($value)->value('value');

        if (! $conversionTax) {
            return 0;
        }

        return bcmul($value, $conversionTax / 100);
    }

    private function getPaymentType(int $paymentTypeId): PaymentType {
        return PaymentType::find($paymentTypeId, ['id', 'name', 'tax']);
    }

    private function getPaymentTax(int $value, PaymentType $paymentType): int {
        return bcmul($value, $paymentType->tax / 100);
    }

    private function getCurrencyOriginValueWithTax(int $value, int $paymentTax, int $conversionTax): int {
        return $value - $paymentTax - $conversionTax;
    }

    private function getCurrencyDestinyValue(int $currencyOriginValueWithTax, float $currencyDestinyConversion): int {
        return bcdiv($currencyOriginValueWithTax, $currencyDestinyConversion);
    }
}

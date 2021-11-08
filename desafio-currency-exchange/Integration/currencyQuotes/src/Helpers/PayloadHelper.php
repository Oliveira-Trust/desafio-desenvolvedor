<?php

declare(strict_types=1);

namespace Integration\CurrencyQuotes\src\Helpers;

use App\Models\Exchange;
use Integration\currencyQuotes\src\Exceptions\ExchangeException as ExchangeExceptionAlias;

class PayloadHelper
{
    /**
     * @param mixed[] $response
     * @param mixed[] $payload
     * @return mixed[]
     */
    public static function consolidatePayload(array $response, array $payload): array
    {
        $newResponse = [];
        foreach ($response as $position) {
            foreach ($position as $key => $value) {
                $newResponse[$key] = $value;
            }
        }

        return array_merge($newResponse, $payload);
    }

    /**
     * @param mixed[] $payload
     * @param mixed[] $values
     * @return mixed[]
     */
    public static function transformValuesInMoney(array $payload, array $values): array
    {
        foreach ($payload as $key => $value) {
            if (in_array($key, $values)) {
                $payload[$key] = MoneyHelper::floatToMoney($value);
            }
        }

        return $payload;
    }

    /**
     * @param string $type
     * @return string
     * @throws \App\Exceptions\Config\BuildExceptions
     */
    public static function typePaymentValue(string $type): string
    {
        if (array_key_exists($type, Exchange::BILLING_TYPE)) {
            return Exchange::BILLING_TYPE[$type];
        }

        ExchangeExceptionAlias::notFoundTypePayment();
    }
}

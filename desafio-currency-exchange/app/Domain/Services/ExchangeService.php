<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Component\Enumerators\ExchangeEnumerators;
use Illuminate\Http\Response;
use Integration\CurrencyQuotes\src\Helpers\PayloadHelper;
use Integration\currencyQuotes\src\Rest;

class ExchangeService
{
    /* @var PurchaseFeesService */
    private $purchaseFeesService;

    private CONST KEY_VALUES_MONEY = [
        'value_exchange',
        'bid',
        'value_currecy_exchange',
        'rate_payment',
        'rate_value',
        'final_value'
    ];

    public function __construct(PurchaseFeesService $feesService)
    {
        $this->purchaseFeesService = $feesService;
    }

    /**
     * @param mixed[] $payload
     * @return mixed[]
     */
    public function enterExchangeProccess(array $payload): array
    {
        $response = [];
        $value_exchange = (float)data_get($payload, 'value_exchange');
        $type_payment = (string)data_get($payload, 'type_payment');

        if ($this->validateValueExchange($value_exchange)) {
            $response = Rest::lastOccurrence($payload);
        }

        $newPayload = PayloadHelper::consolidatePayload($response, $payload);;
        $newResponse = $this->unifyPayloadEnterAndResponseAndApplyRate($newPayload);

        $payload = $this->convertCurrency($newResponse);
        $payload['type_payment'] = PayloadHelper::typePaymentValue($type_payment);
        $finalResponse = PayloadHelper::transformValuesInMoney($payload, self::KEY_VALUES_MONEY);

        return $finalResponse;

    }

    /**
     * @throws \Exception
     */
    public function validateValueExchange(float $value): bool
    {
        if ($value > ExchangeEnumerators::MAX_VALUE_PURCHASE ||
            $value < ExchangeEnumerators::MIN_VALUE_PURCHASE) {
            throw new \Exception(
                "Valor de compra deve ser maior que R$ 1.000,00 ou menor que R$ 100.000,00",
                Response::HTTP_BAD_REQUEST
            );
        }

        return true;
    }

    /**
     * @param mixed[] $payload
     * @return mixed[]
     */
    public function unifyPayloadEnterAndResponseAndApplyRate(array $payload): array
    {
        $discountsRate = $this->purchaseFeesService->applyChargesForPurchase($payload);

        return array_merge($payload, $discountsRate);
    }

    /**
     * @param mixed[] $payload
     * @return mixed[]
     */
    private function convertCurrency(array $payload): array
    {
        $priceBid = data_get($payload, 'bid');
        $valueAfterRate = data_get($payload, 'final_value');
        $payload['value_currecy_exchange'] = $valueAfterRate / $priceBid;

        return $payload;
    }
}

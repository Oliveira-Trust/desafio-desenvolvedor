<?php

namespace App\UseCases\CurrencyConversion;

use App\Contracts\CurrencyConversionDtoContract;
use App\Enum\EconomiaAwesomeResponseCodeEnum;
use App\Exception\CoinNotExistException;
use App\Exception\ConversionFailedException;
use App\Factories\Taxes\TaxFactory;
use App\Repositories\CurrencyConversionContractRepository;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;

class CurrencyConversionUseCase
{
    public function __construct(
        protected CurrencyConversionContractRepository $currencyConversionRepository,
    ) {
    }

    /**
     * @param  CurrencyConversionDtoContract[] $conversions
     * @return CurrencyConversionDtoContract[]
     */
    public function execute(array $conversions): array
    {
        $pairs = [];
        foreach ($conversions as $conversion) {
            $pairs[] = $this->getCoinKey($conversion);
        }

        try {
            $coins = $this->currencyConversionRepository->convert($pairs);
        } catch (RequestException $t) {
            $code = $t->response->json('code');

            match (EconomiaAwesomeResponseCodeEnum::tryFrom($code)) {
                EconomiaAwesomeResponseCodeEnum::COIN_NOT_EXISTS => throw new CoinNotExistException(),
                default => throw new ConversionFailedException(),
            };
        }

        $taxes = TaxFactory::factory();
        foreach ($conversions as $conversion) {
            foreach ($taxes as $tax) {
                $conversion = $tax->execute($conversion);
            }

            $key = $this->getBidKey($conversion);
            $rate = Arr::get($coins, $key);
            $rate = number_format($rate, 4);
            $convertableRate = 1 / $rate;
            $convertableRate = $convertableRate * 10000;
            $conversion->setConvertableRate($convertableRate);

            $convertableValue = $conversion->getConvertableValue();

            $convertedValue = ($convertableValue * $rate);
            $conversion->setConvertedValue($convertedValue);
        }

        return $conversions;
    }

    protected function getCoinKey(CurrencyConversionDtoContract $currencyConversionDto): string
    {
        return $currencyConversionDto->getOrigin() . '-' . $currencyConversionDto->getTarget();
    }

    protected function getBidKey(CurrencyConversionDtoContract $currencyConversionDto): string
    {
        return $currencyConversionDto->getOrigin() . $currencyConversionDto->getTarget() . '.bid';
    }
}

<?php

declare(strict_types=1);

namespace AwesomeApi\Adapters;

class AdapterCurrencyCollection
{
    private array $currencies;
    private array $currenciesAdapted;
    private const CURRENCY_DEFAULT = 'BRL';

    /** @param string[] $array */
    public function __construct(array $currencies)
    {
        $this->currencies = $currencies;
    }

    /** @return string[] */
    public function getCurrencies(): array
    {
        foreach ($this->currencies as $prefix => $label) {
            $this->AdaptCombinationOnlyBrl($prefix, $label);
        }

        return $this->currenciesAdapted;
    }

    private function AdaptCombinationOnlyBrl($prefix, $label): void
    {
        if (str_contains($prefix, self::CURRENCY_DEFAULT . '-')) {
            $this->currenciesAdapted[] = [
                'prefix' => $prefix,
                'label' => explode('/', $label)[1] ?? ''
            ];
        }
    }
}

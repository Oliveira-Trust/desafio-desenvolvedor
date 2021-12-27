<?php

namespace CurrencyConverter\Domain\Currency\Services;

use CurrencyConverter\Domain\Currency\DTOs\FormData as FormDataDTO;
use CurrencyConverter\Domain\Currency\Repositories\CurrencyInterface;
use CurrencyConverter\Domain\Currency\Specifications\{PaymentMethodShouldBeValid,
    PurchasePriceShouldBeGreaterThan1000,
    PurchasePriceShouldBeLessThan100000};
use CurrencyConverter\Domain\Currency\Specifications\Abstracts\AndSpecification;

/**
 * Class CurrencyService
 * @package CurrencyConverter\Domain\Currency\Services
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class CurrencyService
{
    private CurrencyInterface $currencyRepository;

    public function __construct(CurrencyInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    /**
     * @return Array
     */
    public function listAvailablesCombinations() : Array
    {
        $data = $this->currencyRepository->findAvailablesCombinations();
        $prefix = 'BRL-';

        $items = [];
        foreach ( $data as $key => $value )
        {
            $newKey = \Str::replace($prefix,'', $key);
            $newValue = \Str::replace($prefix,'', $key).' - '.\Str::replace('Real Brasileiro/','', $value);

            $items[$newKey] = $newValue;
        }

        return \Arr::sort($items);
    }

    /**
     * @param FormDataDTO $dto
     * @return array
     */
    public function getQuotation(FormDataDTO $dto) : array
    {
        $spec = new AndSpecification();
        $spec->add(new PaymentMethodShouldBeValid());
        $spec->add(new PurchasePriceShouldBeGreaterThan1000());
        $spec->add(new PurchasePriceShouldBeLessThan100000());

        return current($this->currencyRepository->findQuotationFromBRLTo($dto::$destinyCurrency));
    }
}

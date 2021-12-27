<?php

namespace CurrencyConverter\Domain\Currency\Specifications;

use CurrencyConverter\Domain\Currency\DTOs\FormData as FormDataDTO;
use CurrencyConverter\Domain\Currency\Specifications\Abstracts\Specification;

/**
 * Class PaymentMethodShouldBeValid
 * @package CurrencyConverter\Domain\Currency\Specifications\Abstracts
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class PurchasePriceShouldBeLessThan100000 extends Specification
{
    public function isSatisfiedBy(FormDataDTO $dto): bool
    {
        if( $dto::$valueConversion >= 100000 ){
            throw new \DomainException('Purchase Price is greater than or equal 100000!');
        }
        return true;
    }
}

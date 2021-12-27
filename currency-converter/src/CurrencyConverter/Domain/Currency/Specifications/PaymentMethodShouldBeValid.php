<?php

namespace CurrencyConverter\Domain\Currency\Specifications;

use CurrencyConverter\Domain\Currency\DTOs\FormData as FormDataDTO;
use CurrencyConverter\Domain\Currency\Specifications\Abstracts\Specification;

/**
 * Class PaymentMethodShouldBeValid
 * @package CurrencyConverter\Domain\Currency\Specifications\Abstracts
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class PaymentMethodShouldBeValid extends Specification
{
    public function isSatisfiedBy(FormDataDTO $dto): bool
    {
        if( $dto::$paymentMethod != 1 && $dto::$paymentMethod != 2 ){
            throw new \DomainException('Invalid Payment method!');
        }
        return true;
    }
}

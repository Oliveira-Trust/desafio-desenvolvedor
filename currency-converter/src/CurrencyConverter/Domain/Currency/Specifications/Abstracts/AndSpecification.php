<?php

namespace CurrencyConverter\Domain\Currency\Specifications\Abstracts;

use CurrencyConverter\Domain\Currency\DTOs\FormData as FormDataDTO;

/**
 * Class AndSpecification
 * @package CurrencyConverter\Domain\Currency\Specifications
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 * @see http://www.inanzzz.com/index.php/post/xme1/specifications-design-pattern-example-in-php
 */
class AndSpecification extends Specification
{
    /**
     * @param FormDataDTO $dto
     * @return bool
     */
    public function isSatisfiedBy(FormDataDTO $dto): bool
    {
        foreach ($this->specifications as $specification) {
            if (! $specification->isSatisfiedBy($dto)) {
                return false;
            }
        }
        return true;
    }
}

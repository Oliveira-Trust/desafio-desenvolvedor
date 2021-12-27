<?php

namespace CurrencyConverter\Domain\Currency\Specifications\Abstracts;

use CurrencyConverter\Domain\Currency\DTOs\FormData as FormDataDTO;

/**
 * Interface SpecificationInterface
 * @package CurrencyConverter\Domain\Currency\Specifications
 * @see http://www.inanzzz.com/index.php/post/xme1/specifications-design-pattern-example-in-php
 */
interface SpecificationInterface
{
    public function add(SpecificationInterface $specifications): self;

    public function isSatisfiedBy(FormDataDTO $dto): bool;
}

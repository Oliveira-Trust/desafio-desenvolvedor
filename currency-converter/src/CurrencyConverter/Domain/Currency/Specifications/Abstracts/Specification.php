<?php

namespace CurrencyConverter\Domain\Currency\Specifications\Abstracts;

use CurrencyConverter\Domain\Currency\DTOs\FormData as FormDataDTO;

/**
 * Class Specification
 * @package CurrencyConverter\Domain\Currency\Specifications
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 * @see http://www.inanzzz.com/index.php/post/xme1/specifications-design-pattern-example-in-php
 */
abstract class Specification implements SpecificationInterface
{
    protected string $dtoFieldName = 'not defined';
    protected array $specifications;

    public function add(SpecificationInterface $specifications): self
    {
        $this->specifications[] = $specifications;

        return $this;
    }

    /**
     * If at least one specification is true, return true, else return false
     * @param FormDataDTO $dto
     * @return bool
     */
    abstract public function isSatisfiedBy(FormDataDTO $dto): bool;
}

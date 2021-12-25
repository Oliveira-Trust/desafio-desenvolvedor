<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repositories\CurrencyRepository")
 * @ORM\Table(name="currency")
 */
class Currency
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $code;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="float")
     */
    private $value;

    public function getId(): int
    {
        return $this->id;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getValue(): float
    {
        return $this->value;
    }

    public function setCode(string $code): Currency
    {
        $this->code = $code;
        return $this;
    }
    public function setName(string $name): Currency
    {
        $this->name = $name;
        return $this;
    }
    public function setValue(float $value): Currency
    {
        $this->value = $value;
        return $this;
    }
}

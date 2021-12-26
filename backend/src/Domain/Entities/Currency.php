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
    private $codein;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="float")
     */
    private $salePrice;
    /**
     * @ORM\Column(type="float")
     */
    private $purchasePrice;

    public function getId(): int
    {
        return $this->id;
    }
    public function getCode(): string
    {
        return $this->code;
    }
    public function getCodein(): string
    {
        return $this->codein;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getSalePrice(): float
    {
        return $this->salePrice;
    }
    public function getPurchasePrice()
    {
        return $this->purchasePrice;
    }
    public function setCode(string $code): Currency
    {
        $this->code = $code;
        return $this;
    }
    public function setCodein(string $codein): Currency
    {
        $this->codein = $codein;
        return $this;
    }
    public function setName(string $name): Currency
    {
        $this->name = $name;
        return $this;
    }
    
    public function setPurchasePrice(float $purchasePrice): Currency
    {
        $this->purchasePrice = $purchasePrice;
        return $this;
    }
    public function __toString()
    {
        return $this->getName() . '(' .$this->getId() . ')';
    }
}

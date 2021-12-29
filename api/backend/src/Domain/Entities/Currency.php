<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Contracts\Repository\CurrencyRepositoryInterface")
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
    /**
     * One Currency has many transaction. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="dataToConvert")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }

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
    public function setSalePrice(float $salePrice)
    {
        $this->salePrice = $salePrice;
        return $this;
    }
    public function setPurchasePrice(float $purchasePrice): Currency
    {
        $this->purchasePrice = $purchasePrice;
        return $this;
    }
    public function toArray()
    {
        $array = [];
        $keys = array_keys(get_class_vars(get_class($this)));
        foreach($keys as $key ){
            if($key == 'transactions') {
                continue;
            }
            $method = 'get'.str_replace(" ", '', ucwords(str_replace('_', ' ', $key))) ;
            $array[$key] = $this->$method();
        }
        return $array;
    }
    public function __toString()
    {
        return $this->getName() . '(' .$this->getId() . ')';
    }
}

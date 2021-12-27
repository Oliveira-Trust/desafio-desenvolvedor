<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Contracts\Repository\PaymentRepositoryInterface")
 * @ORM\Table(name="payment_type")
 */
class Payment
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
    private $type;
    /**
     * @ORM\Column(type="float")
     */
    private $conversionTax;
    /**
     * One Payment has many transaction. This is the inverse side.
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="paymentType")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
    }
    public function getId()
    {
        return $this->id;
    }
    public function getType()
    {
        return $this->type;
    }
    public function getConversionTax()
    {
        return $this->conversionTax;
    }
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }
    public function __toString()
    {
        return $this->getType();
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
    public function setConversionTax(float $tax)
    {
        $this->conversionTax = $tax;
        return $this;
    }
}
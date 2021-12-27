<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Contracts\TransactionRepositoryInterface")
 * @ORM\Table(name="transactions")
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     */
    private $originCurrency;
    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     */
    private $destinationCurrency;
    /**
     * @ORM\ManyToOne(targetEntity="Payment")
     */
    private $paymentType;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="transactions")
     */
    private $user;
    /**
     * @ORM\Column(type="string")
     */
    private $status;
    /**
     * @ORM\Column(type="float")
     */
    private $value;
    /**
     * @ORM\Column(name="createdat", type="datetimetz", nullable=false, options={"default":"CURRENT_TIMESTAMP"})
     */
    private $date;

    public function getId()
    {
        return $this->id;
    }
    public function getOriginCurrency()
    {
        return $this->originCurrency;
    }
    public function getDestinationCurrency()
    {
        return $this->destinationCurrency;
    }
    public function getPaymentType()
    {
        return $this->paymentType;
    }
    public function getUser()
    {
        return $this->user;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getValue()
    {
        return $this->value;
    }
    public function setValue(float $value)
    {
        $this->value = $value;
        return $this;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setOriginCurrency(Currency $originCurrency)
    {
        $this->originCurrency = $originCurrency;
        return $this;
    }
    public function setDestinationCurrency(Currency $destinationCurrency)
    {
        $this->destinationCurrency = $destinationCurrency;
        return $this;
    }
    public function setPaymentType(Payment $payment)
    {
        $this->payment = $payment;
        return $this;
    }
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
    
    public function setStatus(string $status)
    {
        $this->status = $status;
        return $this;
    }
    public function setDate($date)
    {
        $this->date = $date;
        return $this;
    }
    public function convertValue()
    {
        $valueTransaction = $this->getValue();
        // tirar do valor a taxa de tipo de pagamento
        $type = $this->getPaymentType();
        var_dump($type);
        exit;
        $paymentTax = $this->getPaymentType()->getConversionRate();
        $valueWithoutPaymentTax = $valueTransaction - ($valueTransaction * $paymentTax);
        echo $valueWithoutPaymentTax;
        exit;
        // tirar do valor restante a taxa de conversao 
        // converter o valor restante;
        $valorCompra = $this->getOriginCurrency()->getSalePrice();
        return $valueTransaction * $valorCompra;
    }
    public function toArray()
    {
        $array = [];
        $keys = array_keys(get_class_vars(get_class($this)));
        foreach($keys as $key ){
            if($key == 'user' || $key == 'originCurrency' || $key == 'destinationCurrency' || $key == 'paymentType') {
                $array[$key] = $this->{$key};
                continue;
            } 
            $method = 'get'.str_replace(" ", '', ucwords(str_replace('_', ' ', $key))) ;
            $array[$key] = $this->$method();
        }
        return $array;
    }
    public function __toString()
    {
        return $this->getPaymentType() . '('.$this->getId().')';
    }
}
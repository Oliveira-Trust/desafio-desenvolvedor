<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repositories\TransactionRepository")
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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="transations")
     */
    private $user;

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
    public function setPayment(Payment $payment)
    {
        $this->payment = $payment;
        return $this;
    }
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
}
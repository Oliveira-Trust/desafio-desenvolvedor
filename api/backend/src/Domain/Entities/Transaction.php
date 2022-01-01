<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;
use NumberFormatter;

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
    * Many transactions have one Currency. This is the owning side.
    * @ORM\ManyToOne(targetEntity="Currency", inversedBy="transactions", cascade={"persist"} )
    * @ORM\JoinColumn(name="dataToConvert_id", referencedColumnName="id")
    */
    private $dataToConvert;
    /**
    * Many transactions have one paymment. This is the owning side.
    * @ORM\ManyToOne(targetEntity="Payment", inversedBy="transactions", cascade={"persist"} )
    * @ORM\JoinColumn(name="paymentType_id", referencedColumnName="id")
    */
    private $paymentType;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="transactions", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
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
    public function getDataToConvert()
    {
        return $this->dataToConvert;
    }
    public function getPayment()
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
    public function getDate($format = '')
    {
        return ($this->date && $format !== '') ?
            $this->date->format($format) : $this->date;
    }
    public function setDataToConvert(Currency $dataToConvert)
    {
        $this->dataToConvert = $dataToConvert;
        return $this;
    }
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }
    public function setPayment(Payment $payment)
    {
        $this->paymentType = $payment;
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
    public function convertValue(TaxTransaction $taxConvertion)
    {
        $valueCoinDestino = (1 / $this->dataToConvert->getSalePrice());
        $code = $this->dataToConvert->getCode();
        $codein = $this->dataToConvert->getCodein();

        $taxPayment = ($this->paymentType->getConversionTax() / 100);
        $taxLowValue = ($taxConvertion->getRateForlowValue() / 100);
        $taxHighValue =  ($taxConvertion->getRateForHighValue() / 100);
        
        $amountTaxPayment = ($this->value * $taxPayment);
        $isLowOrHighValue = ($this->value < $taxConvertion->getLowValue());
        $taxConvertion = $isLowOrHighValue ? $taxLowValue : $taxHighValue;

        $amountTaxConvertion = ($taxConvertion * $this->value);
        $convertedValue = ($this->value - $amountTaxConvertion - $amountTaxPayment);
        
        return [
            "moeda_origem" => $code,
            "moeda_destino"=> $codein,
            "valor_para_conversao" => $this->value,
            "forma_pagamento" => $this->paymentType->getType(),
            "valor_moeda_destino" => $valueCoinDestino,
            "valor_comprado" => ($convertedValue / $valueCoinDestino),
            "taxa_pagamento" => $amountTaxPayment,
            "taxa_conversao" => $amountTaxConvertion,
            "valor_convertido" => $convertedValue,
            "data_transaction" => $this->getDate('Y-m-d H:i:s')
        ];
    }
    private function formatMoney($amount)
    {
        $fmt = new NumberFormatter('', NumberFormatter::CURRENCY);
        return $fmt->format($amount);
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
        return $this->getPayment() . '('.$this->getId().')';
    }
}
<?php
declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Contracts\TaxTransactionRepositoryInterface")
 * @ORM\Table(name="tax_transactions")
 */
class TaxTransaction
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    /**
     * Minimum amount allowed
     * @ORM\Column(type="float")
     */
    private $minimumTransactionValue;
    /**
     * Maximum amount allowed
     * @ORM\Column(type="float")
     */
    private $maximumTransactionValue;
    /**
     * Fee to be applied for low value
     * @ORM\Column(type="float")
     */
    private $rateForlowValue;
    /**
     * 
     * @ORM\Column(type="float")
     */
    private $lowValue;
    /**
     * @ORM\Column(type="float")
     */
    private $rateForHighValue;

    public function getId()
    {
        return $this->id;
    }
    
    public function getRateForlowValue()
    {
        return $this->rateForlowValue;
    }
    public function setRateForlowValue($rateForlowValue): TaxTransaction
    {
        $this->rateForlowValue = $rateForlowValue;
        return $this;
    }
    public function getLowValue(): float
    {
        return $this->lowValue;
    }
    public function setLowValue($lowValue): TaxTransaction
    {
        $this->lowValue = $lowValue;
        return $this;
    }
    public function getRateForHighValue(): float
    {
        return $this->rateForHighValue;
    }
    public function setRateForHighValue(float $rateForHighValue): TaxTransaction
    {
        $this->rateForHighValue = $rateForHighValue;
        return $this;
    }
    public function getMaximumTransactionValue(): float
    {
        return $this->maximumTransactionValue;
    }
    public function setMaximumTransactionValue(float $maximumTransactionValue): TaxTransaction
    {
        $this->maximumTransactionValue = $maximumTransactionValue;
        return $this;
    }
    public function getMinimumTransactionValue()
    {
        return $this->minimumTransactionValue;
    }
    public function setMinimumTransactionValue($minimumTransactionValue)
    {
        $this->minimumTransactionValue = $minimumTransactionValue;
        return $this;
    }
    public function toArray()
    {
        $array = [];
        $keys = array_keys(get_class_vars(get_class($this)));
        foreach($keys as $key ){
            $method = 'get'.str_replace(" ", '', ucwords(str_replace('_', ' ', $key))) ;
            $array[$key] = $this->$method();
        }
        return $array;
    }
}
<?php

declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Repositories\PaymentRepository")
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
    private $name;
    /**
     * @ORM\Column(type="float")
     */
    private $conversionRate;

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getConversionRate()
    {
        return $this->conversionRate;
    }
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }
    public function setConversionRate(float $rate)
    {
        $this->conversionRate = $rate;
        return $this;
    }
}
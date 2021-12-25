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
     * @ORM\JoinColumn(name="origin_currency_id", referencedColumnName="id")
     */
    private $originCurrency;
    /**
     * @ORM\ManyToOne(targetEntity="Currency")
     * @ORM\JoinColumn(name="destination_currency_id", referencedColumnName="id")
     */
    private $destinationCurrency;

    private $paymentType;
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="transations")
     */
    private $user;

}
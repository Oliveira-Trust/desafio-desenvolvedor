<?php
declare(strict_types=1);

namespace App\Domain\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Domain\Contracts\UserRepositoryInterface")
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    protected $id;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="string")
     */
    protected $username;
    /**
     * @ORM\Column(type="string")
     */
    protected $email;
    /**
     * @ORM\Column(type="string")
     */
    protected $password;
    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="user")
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
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }
    public function getUsername()
    {
        return $this->username;
    }
    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        return $this;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function validatePassword(string $password, string $has): bool
    {
        return password_verify($password, $has);
    }
    public function setTransactions(Transaction $transaction)
    {
        $this->transactions->add($transaction);
        return $this;
    }
    public function getTransactions(TaxTransaction $taxTransaction)
    {
        $response = [ "user" => $this->toArray() ];
        $response["user"]["transactions"] = [];

        foreach($this->transactions as $transaction) {
            $response["user"]["transactions"][] = $transaction->convertValue($taxTransaction);
        }
        return $response;
    }
    public function toArray()
    {
        $array = [];
        $keys = array_keys(get_class_vars(get_class($this)));
        foreach($keys as $key ){
            if($key == 'password' || $key == 'transactions') {
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
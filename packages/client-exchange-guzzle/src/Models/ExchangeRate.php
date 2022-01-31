<?php

namespace ExchangeRate\Models;

class ExchangeRate
{
    /**
     * @var string
     */
    public $from; //code
    /**
     * @var string
     */
    public $to; // codein
    /**
     * @var string
     */
    public $name;
    /**
     * @var float
     */
    public $high;
    /**
     * @var float
     */
    public $low;
    /**
     * @var float
     */
    public $varBid;
    /**
     * @var float
     */
    public $pctChange;
    /**
     * @var float
     */
    public $bid;
    /**
     * @var float
     */
    public $ask;
    /**
     * @var \DateTime
     */
    public $timestamp;
    /**
     * @var \DateTime
     */
    public $created_at; // created_date

    public function __set($name, $value)
    {
        if (strtolower($name) === 'timestamp' || $name === 'created_at') {
            if(!($value instanceof \DateTime))
                throw new \Exception("A propriedade \"{$name}\" deve ser do tipo \"DateTime\"");
            $this->$name =  $value;
        } else if (in_array($name, ['varBid', 'pctChange', 'bid', 'ask']) ) {
            if(!is_float($value))
                throw new \Exception("A propriedade \"{$name}\" deve ser do tipo \"float\"");
            $this->$name = $value;
        } else if (in_array($name, ['from', 'to', 'name'])) {
            if(!is_string($value))
                throw new \Exception("A propriedade \"{$name}\" deve ser do tipo \"string\"");
            $this->$name = $value;
        }else{
            throw new \Exception("A propriedade \"{$name}\" não existe em " . get_class($this)."!");
        }
    }
}

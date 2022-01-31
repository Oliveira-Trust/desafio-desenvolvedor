<?php

namespace ExchangeRate\Models;

class Currency
{
    /**
     * @var string
     */
    public $code;
    /**
     * @var string
     */
    public $name;

    /**
     * @param string $code
     * @param string $name
     */
    public function __construct(string $code, string $name)
    {
        $this->code = $code;
        $this->name = $name;
    }

}

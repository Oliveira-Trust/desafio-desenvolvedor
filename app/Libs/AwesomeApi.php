<?php

namespace App\Libs;

class AwesomeApi
{
    private $host;

    public function __construct()
    {
        $this->host = config('awesome.host');
    }
}

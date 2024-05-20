<?php

namespace App\Services\AwesomeApiQuotes\Endpoints;


trait HasCurrencies
{
    public function currencies(): Currencies
    {
        return new Currencies();
    }
}

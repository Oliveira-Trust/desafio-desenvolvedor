<?php

namespace App\Services\AwesomeApiQuotes\Endpoints;


trait HasQuotes
{
    public function quotes(): Quotes
    {
        return new Quotes();
    }
}

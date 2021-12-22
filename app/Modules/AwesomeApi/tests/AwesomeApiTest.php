<?php

use AwesomeApi\Requesters\AwesomeApiRequester;

class AwesomeApiTest extends TestCase
{
    protected $awesomeApiRequester;

    public function __construct()
    {
        parent::__construct();
        $this->awesomeApiRequester = app(AwesomeApiRequester::class);
    }

    public function testGetCurrencies()
    {
        $currencies = $this->awesomeApiRequester->getCurrencies();
        $this->assertIsObject($currencies);
    }
}

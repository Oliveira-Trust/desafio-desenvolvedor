<?php

namespace Tests\Unit\Services\AwesomeApiQuotes\Entities;

use App\Services\AwesomeApiQuotes\Entities\Quote;
use PHPUnit\Framework\TestCase;

class QuoteTest extends TestCase
{
    public function testCreateQuoteFromArray()
    {
        $data = [
            'code' => 'USD',
            'codein' => 'BRL',
            'name' => 'Dólar Americano/Real Brasileiro',
            'high' => 5.734,
            'low' => 5.7279,
            'varBid' => -0.0054,
            'pctChange' => -0.09,
            'bid' => 5.7276,
            'ask' => 5.7282,
            'timestamp' => 1618315045,
            'create_date' => '2021-04-13 08:57:27'
        ];

        $quote = new Quote(
            $data['code'],
            $data['codein'],
            $data['name'],
            $data['high'],
            $data['low'],
            $data['varBid'],
            $data['pctChange'],
            $data['bid'],
            $data['ask'],
            $data['timestamp'],
            new \DateTime($data['create_date'])
        );

        $this->assertInstanceOf(Quote::class, $quote);
        $this->assertEquals($data['code'], $quote->getCode());
        $this->assertEquals($data['codein'], $quote->getCodein());
        $this->assertEquals($data['name'], $quote->getName());
        $this->assertEquals($data['high'], $quote->getHigh());
        $this->assertEquals($data['low'], $quote->getLow());
        $this->assertEquals($data['varBid'], $quote->getVarBid());
        $this->assertEquals($data['pctChange'], $quote->getPctChange());
        $this->assertEquals($data['bid'], $quote->getBid());
        $this->assertEquals($data['ask'], $quote->getAsk());
        $this->assertEquals($data['timestamp'], $quote->getTimestamp());
        $this->assertInstanceOf(\DateTime::class, $quote->getCreateDate());
        $this->assertEquals($data['create_date'], $quote->getCreateDate()->format('Y-m-d H:i:s'));
    }
}

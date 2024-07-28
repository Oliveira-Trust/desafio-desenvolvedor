<?php

namespace App\Dtos;

class QuotationResponseDto
{
    public string $code;
    public string $codein;
    public string $name;
    public string $high;
    public string $low;
    public string $varBid;
    public string $pctChange;
    public string $bid;
    public string $ask;
    public string $timestamp;
    public string $createDate;

    public function __construct(array $data)
    {
        $this->code = $data['code'];
        $this->codein = $data['codein'];
        $this->name = $data['name'];
        $this->high = $data['high'];
        $this->low = $data['low'];
        $this->varBid = $data['varBid'];
        $this->pctChange = $data['pctChange'];
        $this->bid = $data['bid'];
        $this->ask = $data['ask'];
        $this->timestamp = $data['timestamp'];
        $this->createDate = $data['create_date'];
    }
}

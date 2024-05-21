<?php

namespace App\Services\AwesomeApiQuotes\Entities;

class QuoteEntity

{
    private string $code;
    private string $codein;
    private string $name;
    private float $high;
    private float $low;
    private float $varBid;
    private float $pctChange;
    private float $bid;
    private float $ask;
    private int $timestamp;
    private \DateTime $createDate;

    public function __construct(
        string $code,
        string $codein,
        string $name,
        float $high,
        float $low,
        float $varBid,
        float $pctChange,
        float $bid,
        float $ask,
        int $timestamp,
        \DateTime $createDate
    ) {
        $this->code = $code;
        $this->codein = $codein;
        $this->name = $name;
        $this->high = $high;
        $this->low = $low;
        $this->varBid = $varBid;
        $this->pctChange = $pctChange;
        $this->bid = $bid;
        $this->ask = $ask;
        $this->timestamp = $timestamp;
        $this->createDate = $createDate;
    }

    // Getters
    public function getCode(): string
    {
        return $this->code;
    }

    public function getCodein(): string
    {
        return $this->codein;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getHigh(): float
    {
        return $this->high;
    }

    public function getLow(): float
    {
        return $this->low;
    }

    public function getVarBid(): float
    {
        return $this->varBid;
    }

    public function getPctChange(): float
    {
        return $this->pctChange;
    }

    public function getBid(): float
    {
        return $this->bid;
    }

    public function getAsk(): float
    {
        return $this->ask;
    }

    public function getTimestamp(): int
    {
        return $this->timestamp;
    }

    public function getCreateDate(): \DateTime
    {
        return $this->createDate;
    }

    // Static method to create a Quote from an array
    public static function fromArray(array $data): self
    {
        return new self(
            $data['code'],
            $data['codein'],
            $data['name'],
            (float) $data['high'],
            (float) $data['low'],
            (float) $data['varBid'],
            (float) $data['pctChange'],
            (float) $data['bid'],
            (float) $data['ask'],
            (int) $data['timestamp'],
            new \DateTime($data['create_date'])
        );
    }
}

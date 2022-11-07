<?php

namespace App\Services;

use App\Models\Exchange;

class ExchangeService
{
    public function saveExchange(object $user, array $exchange): void
    {
        $data = [
            'user_id' => $user->id,
            'values'  => json_encode($exchange)
        ];
        Exchange::create($data);
    }

    public function getExchangesByUserId(object $user): array
    {
        $exchangeList = Exchange::where('user_id', $user->id);
        return $exchangeList->toArray();
    }
}

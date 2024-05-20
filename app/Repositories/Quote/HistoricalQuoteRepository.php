<?php

namespace App\Repositories\Quote;
use App\Interface\Quote\HistoricalQuoteInterface;

use App\Models\User;
use App\Models\QuoteHistory;

class HistoricalQuoteRepository implements HistoricalQuoteInterface
{

    public function index(int $user_id): array
    {
        return QuoteHistory::where('user_id', $user_id)->get();
    }

    public function store(int $user_id, array $data): QuoteHistory
    {
        return QuoteHistory::create([
            'user_id' => $user_id,
            ...$data
        ]);
    }

    public function update(int $id, array $data): QuoteHistory
    {
        $quote = QuoteHistory::findOrFail($id);
        $quote->update($data);

        return $quote;
    }

}
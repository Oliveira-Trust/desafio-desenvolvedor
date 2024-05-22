<?php

namespace App\Repositories\Quote;
use App\Interface\Quote\HistoricalQuoteInterface;

use App\Models\User;
use App\Models\QuoteHistory;

class HistoricalQuoteRepository implements HistoricalQuoteInterface
{

    public function index(int $user_id): array
    {
        $quoteHistories = QuoteHistory::where('user_id', $user_id)
            ->orderBy('id', 'desc')
            ->get();

        return $this->convertValues($quoteHistories);
    }

    private function convertValues($quoteHistories)
    {
        return $quoteHistories->map(function ($history) {
            return [
                'id' => $history->id,
                'user_id' => $history->user_id,
                'origin_currency' => $history->origin_currency,
                'destination_currency' => $history->destination_currency,
                'payment_method' => $history->payment_method,
                'original_amount' => $this->convertValue($history->original_amount),
                'converted_amount' => $this->convertValue($history->converted_amount),
                'exchange_rate' => $this->convertValue($history->exchange_rate),
                'tax_rate_value' => $this->convertValue($history->tax_rate_value),
                'tax_rate_value_porcentages' => $history->tax_rate_value_porcentages,
                'tax_conversion_value' => $this->convertValue($history->tax_conversion_value),
                'tax_conversion_percentage' => $history->tax_conversion_percentage,
                'tax_total' => $this->convertValue($history->tax_total),
                'original_value_minus_tax' => $this->convertValue($history->original_value_minus_tax),
                'email_sent_at' => $history->email_sent_at,
                'created_at' => $history->created_at,
                'updated_at' => $history->updated_at,
            ];
        })->toArray();
    }

    private function convertValue($value)
    {
        return $value / 1000;
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
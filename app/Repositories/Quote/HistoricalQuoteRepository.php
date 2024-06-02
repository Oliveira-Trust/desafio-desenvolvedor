<?php

namespace App\Repositories\Quote;
use App\Interface\Quote\HistoricalQuoteInterface;

use App\Models\User;
use App\Models\QuoteHistory;
use App\Helpers\CurrencyHelper;

class HistoricalQuoteRepository implements HistoricalQuoteInterface
{

    public function index(int $user_id, int $page = 1, $perPage = 10, $sortKey = "id", $sortOrder = "desc")
    {
        $quoteHistories = QuoteHistory::where('user_id', $user_id)
            ->orderBy($sortKey, $sortOrder)
            ->paginate($perPage, ['*'], 'page', $page);

        $quoteHistories->getCollection()->transform(function ($history) {
            return $this->convertValues($history);
        });

        return $quoteHistories;
    }

    private function convertValues($history)
    {
        return [
            'id' => $history->id,
            'user_id' => $history->user_id,
            'origin_currency' => $history->origin_currency,
            'destination_currency' => $history->destination_currency,
            'payment_method' => $history->payment_method,
            'original_amount' => CurrencyHelper::toCurrency($history->original_amount),
            'converted_amount' => CurrencyHelper::toCurrency($history->converted_amount),
            'exchange_rate' => CurrencyHelper::toCurrency($history->exchange_rate),
            'tax_rate_value' => CurrencyHelper::toCurrency($history->tax_rate_value),
            'tax_rate_value_porcentages' => $history->tax_rate_value_porcentages,
            'tax_conversion_value' => CurrencyHelper::toCurrency($history->tax_conversion_value),
            'tax_conversion_percentage' => $history->tax_conversion_percentage,
            'tax_total' => CurrencyHelper::toCurrency($history->tax_total),
            'original_value_minus_tax' => CurrencyHelper::toCurrency($history->original_value_minus_tax),
            'email_sent_at' => $history->email_sent_at,
            'created_at' => $history->created_at,
            'updated_at' => $history->updated_at,
        ];
    }

    public function store(int $user_id, array $array): QuoteHistory
    {
        $data = [
            'origin_currency' => $array['origin_currency'],
            'destination_currency' => $array['destination_currency'],
            'payment_method' => $array['payment_method'],
            'original_amount' => $array['original_amount'],
            'converted_amount' => $array['conversion_details']['converted_amount'],
            'exchange_rate' => CurrencyHelper::toCents($array['conversion_details']['exchange_rate']),

            'tax_rate_value' => $array['tax']['tax_rate_amount'],
            'tax_rate_value_porcentages' => $array['tax']['tax_rate_percentage'],
            'tax_conversion_value' => $array['tax']['tax_conversion_amount'],
            'tax_conversion_percentage' => $array['tax']['tax_conversion_percentage'],
            'tax_total' => $array['tax']['total_tax_amount'],

            'original_value_minus_tax' => $array['tax']['amount_minus_tax'],
            'email_sent_at' => null,
        ];

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
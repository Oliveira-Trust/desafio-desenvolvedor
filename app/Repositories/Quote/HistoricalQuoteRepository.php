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

    public function update(int $user_id, array $data): QuoteHistory
    {
        $quote = QuoteHistory::where('user_id', $user_id)->first();
        $quote->origin_currency = $data['origin_currency'];
        $quote->destination_currency = $data['destination_currency'];
        $quote->payment_method = $data['payment_method'];
        $quote->original_amount = $data['original_amount'];
        $quote->converted_amount = $data['converted_amount'];
        $quote->exchange_rate = $data['exchange_rate'];
        $quote->tax_rate_value = $data['tax_rate_value'];
        $quote->tax_rate_value_porcentages = $data['tax_rate_value_porcentages'];
        $quote->tax_conversion_value = $data['tax_conversion_value'];
        $quote->tax_conversion_percentage = $data['tax_conversion_percentage'];
        $quote->tax_total = $data['tax_total'];
        $quote->original_value_minus_tax = $data['original_value_minus_tax'];
        $quote->email_sent_at = null;
        $quote->save();

        return $quote;
    }

}
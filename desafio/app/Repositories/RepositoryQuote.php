<?php

namespace App\Repositories;

use App\Models\Quote;

class RepositoryQuote
{
    /**
     * @param array $data
     * @return Quote
     */
    public function save(array $data) : Quote
    {
        $quote = new Quote;

        $quote->code = $data['code'];
        $quote->code_in = $data['codein'];
        $quote->conversion_value = $data['conversion_value'];
        $quote->payment_method = $data['payment_method'];
        $quote->tax = $data['tax'];
        $quote->payment_rate = $data['payment_rate'];
        $quote->conversion_rate = $data['conversion_rate'];
        $quote->conversion_value_tax = $data['conversion_value_tax'];
        $quote->purchased_value = $data['purchased_value'];
        $quote->destination_currency_value = $data['destination_currency_value'];

        $quote->user()->associate(\Auth::user());

        $quote->save();

        return $quote;
    }

    /**
     * @return Illuminate\Support\Collection
     */
    public function get()
    {
        return Quote::query()
            ->where('user_id', \Auth::id())
            ->orderBy('created_at')
            ->get();
    }

    /**
     * @param int $quoteID
     * @return Quote
     */
    public function find(int $quoteID)
    {
        return Quote::find($quoteID);
    }
}
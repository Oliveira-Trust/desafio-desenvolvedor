<?php

namespace App\Interface\Quote;
use App\Models\User;
use App\Models\QuoteHistory;
/**
 * Interface for the Quote Service.
 */
interface HistoricalQuoteInterface
{

    /**
     * Get the historical quotes for a given user.
     *
     * @param int $user The user.
     * @return array An array of historical quotes.
     */
    public function index(int $user_id): array;

    /**
     * Store a new historical quote for a given user.
     *
     * @param int $id The historical quote ID.
     * @param array $data The quote data.
     * @return QuoteHistory The stored quote.
     */
    public function store(int $user_id, array $data): QuoteHistory;

    public function update(int $id, array $data): QuoteHistory;

}
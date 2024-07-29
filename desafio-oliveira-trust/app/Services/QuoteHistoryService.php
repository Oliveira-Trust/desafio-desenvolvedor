<?php

namespace App\Services;

use App\Models\QuoteHistory; 

class QuoteHistoryService
{
    public function getUserQuoteHistory($userId)
    {
        return QuoteHistory::where('user_id', $userId)->get();
    }
}
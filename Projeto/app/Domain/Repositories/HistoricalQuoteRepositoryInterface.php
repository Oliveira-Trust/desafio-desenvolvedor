<?php
// app/Domain/Repositories/HistoricalQuoteRepositoryInterface.php

namespace App\Domain\Repositories;

use App\Domain\Entities\HistoricalQuote;
use App\Domain\Entities\User;

interface HistoricalQuoteRepositoryInterface
{
    public function save(HistoricalQuote $quote): void;
    public function getQuotesByUserId(int $userId): array;
}

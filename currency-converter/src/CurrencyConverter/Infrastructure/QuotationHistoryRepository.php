<?php

namespace CurrencyConverter\Infrastructure;

use CurrencyConverter\Domain\Currency\Models\QuotationHistory;
use CurrencyConverter\Domain\Currency\Repositories\QuotationHistoryInterface;

/**
 * Class QuotationHistoryRepository
 * @package CurrencyConverter\Infrastructure
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class QuotationHistoryRepository implements QuotationHistoryInterface
{
    public function save(array $data): QuotationHistory
    {
        $qHistory = new QuotationHistory();
        $qHistory->destiny_currency = $data['destiny_currency'];
        $qHistory->value_for_conversion = $data['value_for_conversion'];
        $qHistory->payment_method = $data['payment_method'];

        $qHistory->save();
        return $qHistory->fresh();
    }
}

<?php

namespace App\Services;

use App\Models\ExchangeFeeConfiguration;
use Carbon\Carbon;

readonly class ExchangeFeeConfigurationService
{
    function __construct() { }

    /**
     * Set new fee configuration
     *
     * @param float $amount
     * @param float $lt_threshold
     * @param float $gt_threshold
     * @param string $effectiveDate
     * @return ExchangeFeeConfiguration
     */
    public function setConfiguration(float $amount, float $lt_threshold, float $gt_threshold, string $effectiveDate): ExchangeFeeConfiguration
    {
        $effectiveDate = Carbon::parse($effectiveDate);

        $config = new ExchangeFeeConfiguration([
            'amount_threshold' => $amount,
            'lower_than_threshold' => $lt_threshold,
            'greater_than_threshold' => $gt_threshold,
            'effective_date' => $effectiveDate
        ]);

        $config->save();

        return $config;
    }

    /**
     * Get the current fee configuration.
     *
     * @return ExchangeFeeConfiguration
     */
    public function getFeeConfiguration(): ExchangeFeeConfiguration
    {
        return ExchangeFeeConfiguration::orderBy('effective_date', 'desc')->first();
    }
}

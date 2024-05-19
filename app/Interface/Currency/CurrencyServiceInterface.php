<?php

namespace App\Interface\Currency;

interface CurrencyServiceInterface
{
    /**
     * Returns the latest occurrences of the selected currencies.
     *
     * @param string $currencies Currencies selected separated by commas (ex: USD-BRL,EUR-BRL)
     * @return array|null Array with the latest occurrences of the currencies or null in case of error
     */
    public function getLatestOccurrences(string $currencies): ?array;

    /**
     * Returns the list of available currency types together with their names.
     *
     * Example of return:
     * [
     *     'USD-BRL' => 'US Dollar/Brazilian Real',
     *     'USD-BRLT' => 'US Dollar/Brazilian Real Tourism',
     * ]
     *
     * @return array|null Associative array with the available currency types and their names or null in case of error
     */
    public function getAvailableCurrencies(): ?array;

    /**
     * Returns the list of names of available currencies.
     *
     * Example of return:
     * [
     *     'AED' => 'United Arab Emirates',
     *     'AFN' => 'Afghanistan Afghani',
     * ]
     *
     * @return array|null Associative array with the names of the available currencies or null in case of error
     */
    public function getCurrencyNames(): ?array;
}


<?php

namespace CurrencyConverter\Application\Providers;

use CurrencyConverter\Domain\Currency\Repositories\CurrencyInterface;
use CurrencyConverter\Domain\Currency\Repositories\QuotationHistoryInterface;
use CurrencyConverter\Infrastructure\CurrencyRepository;
use CurrencyConverter\Infrastructure\QuotationHistoryRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class RepositoryServiceProvider
 * @package CurrencyConverter\Domain\Currency\Services
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class RepositoryServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CurrencyInterface::class => CurrencyRepository::class,
        QuotationHistoryInterface::class => QuotationHistoryRepository::class
    ];
}

<?php

namespace CurrencyConverter\Domain\Currency\Services;

use CurrencyConverter\Domain\Currency\Repositories\QuotationHistoryInterface;
use Illuminate\Support\Collection;

/**
 * Class CurrencyService
 * @package CurrencyConverter\Domain\Currency\Services
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class QuotationHistoryService
{
    private QuotationHistoryInterface $repository;

    public function __construct(QuotationHistoryInterface $quotationHistoryService)
    {
        $this->repository = $quotationHistoryService;
    }

    public function save(array $data) : array
    {
        return $this->repository->save($data)->toArray();
    }

    public function list() : Collection
    {
        return $this->repository->list();
    }
}

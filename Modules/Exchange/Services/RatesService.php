<?php

namespace Modules\Exchange\Services;

use Modules\Exchange\Entities\Rates;
use Modules\Exchange\Repositories\Contracts\RatesRepositoryInterface;

class RatesService
{
    public function __construct(protected RatesRepositoryInterface $ratesRepository)
    {
    }

    /** @return null|Rates  */
    public function list(): ?Rates
    {
        return $this->ratesRepository->list();
    }

    /**
     * @param array $data
     * @return Rates
     */
    public function updateOrCrate(array $data): Rates
    {
        return $this->ratesRepository->updateOrCrate($data);
    }
}

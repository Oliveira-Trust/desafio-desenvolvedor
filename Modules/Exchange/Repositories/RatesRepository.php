<?php

namespace Modules\Exchange\Repositories;

use Modules\Exchange\Entities\Rates;
use Modules\Exchange\Repositories\Contracts\RatesRepositoryInterface;

class RatesRepository implements RatesRepositoryInterface
{
    public function __construct(protected Rates $rates)
    {
    }

    /** @return null|Rates  */
    public function list(): ?Rates
    {
        return $this->rates->find(1);
    }

    /**
     * @param array $data
     * @return Rates
     */
    public function updateOrCrate(array $data): Rates
    {
        return $this->rates->updateOrCreate(
            ['id' => 1],
            $data
        );
    }
}

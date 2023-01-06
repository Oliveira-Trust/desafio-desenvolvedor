<?php

namespace Modules\Exchange\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;
use Modules\Exchange\Entities\Exchanges;
use Modules\Exchange\Repositories\Contracts\ExchangeRepositoryInterface;
use Modules\User\Entities\User;

class ExchangeRepository implements ExchangeRepositoryInterface
{
    public function __construct(protected Exchanges $exchanges)
    {
    }

    /**
     * @param User $user
     * @return LengthAwarePaginator
     */
    public function list(User $user): LengthAwarePaginator
    {
        return $user->exchanges()->latest()->paginate(10);
    }

    /**
     * @param array $data
     * @return Exchanges
     */
    public function snapShot(array $data): Exchanges
    {
        return $this->exchanges->create($data);
    }
}

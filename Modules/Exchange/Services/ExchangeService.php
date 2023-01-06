<?php

namespace Modules\Exchange\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Modules\Exchange\Entities\Exchanges;
use Modules\Exchange\Enums\Currency;
use Modules\Exchange\Enums\PaymentMethod;
use Modules\Exchange\Repositories\Contracts\ExchangeRepositoryInterface;

class ExchangeService
{
    public function __construct(protected ExchangeRepositoryInterface $exchangeRepository)
    {
    }

    /** @return LengthAwarePaginator  */
    public function list(): LengthAwarePaginator
    {
        return $this->exchangeRepository->list(Auth::user());
    }

    /**
     * @param array $data
     * @return Exchanges
     */
    public function store(array $data): Exchanges
    {
        $data['user_id'] = Auth::user()->id;
        return $this->exchangeRepository->snapShot($data);
    }

    /** @return array<array-key, mixed>  */
    public function paymentMethods()
    {
        return PaymentMethod::map();
    }

    /** @return array<array-key, mixed>  */
    public function currencies()
    {
        return Currency::map();
    }
}

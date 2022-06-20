<?php

namespace Oliveiratrust\Currency;

use App\Http\Controllers\Controller;
use Gate;
use Oliveiratrust\CurrencyPrice\CurrencyPriceRefreshFromAPIService;

class CurrencyController extends Controller {

    public function __construct(
        private CurrencyRepository                 $repository,
        private CurrencyPriceRefreshFromAPIService $fromAPIService
    ){}

    public function index()
    {
        Gate::authorize('can-view-currencies-prices');

        $data = $this->repository->getActivesCurrencies();

        return CurrencyResource::collection($data);
    }

    public function update()
    {
        Gate::authorize('can-refresh-currencies-prices');

        $this->fromAPIService->call();

        return [];
    }
}

<?php

namespace Modules\Exchange\Services;

use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Modules\Exchange\Entities\Exchanges;
use Modules\Exchange\Enums\Currency;
use Modules\Exchange\Enums\PaymentMethod;
use Modules\Exchange\Jobs\ExchangeConversionJob;
use Modules\Exchange\Repositories\Contracts\ExchangeRepositoryInterface;

class ExchangeService
{
    public function __construct(protected ExchangeRepositoryInterface $exchangeRepository, protected RatesService $ratesService)
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

    /**
     * @param array $data
     * @return void
     */
    public function conversion(array $data): void
    {
        $rates = $this->ratesService->list();

        $exchange = $this->getConversionValue($data['destination_currency'], $rates->toArray());

        ExchangeConversionJob::dispatchIf(
            $exchange,
            $data['destination_currency'],
            $data['conversion_value'],
            $data['payment_method'],
            $exchange,
            Auth::user(),
            $this,
            $rates
        );
    }

    /**
     * @param string $currencies
     * @return float
     * @throws Exception
     */
    public function getConversionValue(string $destinationCurrency, array $rates): float
    {
        $currencies = [$destinationCurrency, $rates['base_currency']];

        $response = Http::retry(3, 5000, function ($exception, $request) {
            if ($exception->response->status() !== 200) {
                return $exception instanceof ConnectionException;
            }
        })->get("https://economia.awesomeapi.com.br/last/".implode('-', $currencies));

        return floatval(data_get($response->json(), implode('', $currencies).".high"));
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

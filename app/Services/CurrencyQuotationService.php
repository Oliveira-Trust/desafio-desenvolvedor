<?php

namespace App\Services;

use App\Enums\PaymentType;
use App\Events\CurrencyExchanged;
use App\Mail\CurrencyExchangedMail;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response as HttpResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use stdClass;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CurrencyQuotationService
{
    private readonly PendingRequest $httpRequest;

    public function __construct()
    {
        $this->httpRequest = Http::baseUrl(config('services.quotation.apiBaseUrl'));
    }

    public function getAvailableCurrencies(): Collection
    {
        try {
            $availableCurrencies = collect();

            if (cache()->has('availableCurrencies')) {
                $availableCurrencies = cache()->get('availableCurrencies');
            } else {
                $availableCurrencies = $this->httpRequest->get('/json/available/uniq')
                    ->throw()
                    ->collect()
                    ->sortBy(fn(string $currencyName, string $currencyCode) => $currencyName);

                cache()->put(key: 'availableCurrencies', value: $availableCurrencies, ttl: 3600);
            }

            return $availableCurrencies;
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            request()->session()->flash('error', 'Falha ao recuperar moedas disponíveis da api.');

            return collect();
        }
    }

    public function quoteCurrencies(array $data): ?stdClass
    {
        try {
            $endpoint = $this->mountCurrencyExchangeEndpoint($data);
            $httpResponse = $this->httpRequest->get($endpoint);

            if ($httpResponse->notFound()) {
                throw new NotFoundHttpException("Não existe a combinação das moedas {$data['source_currency']}-{$data['destination_currency']} na API.");
            }

            if ($httpResponse->failed()) {
                throw new \Exception("Falha ao cotar as moedas {$data['source_currency']}-{$data['destination_currency']}.");
            }

            $currencyQuotationData = $this->mountCurrencyQuotationData(requestData: $data, httpResponse: $httpResponse);

            // dispatch the event who send mail to user with currency exchanged data
            CurrencyExchanged::dispatch($currencyQuotationData);

            return $currencyQuotationData;
        } catch (NotFoundHttpException $notFoundHttpException) {
            logger()->warning($notFoundHttpException->getMessage());
            request()->session()->flash('error', $notFoundHttpException->getMessage());

            return null;
        } catch (\Exception $exception) {
            logger()->error($exception->getMessage());
            request()->session()->flash('error', $exception->getMessage());

            return null;
        }
    }

    private function mountCurrencyExchangeEndpoint(array $data): string
    {
        return "/last/{$data['source_currency']}-{$data['destination_currency']}";
    }

    private function mountCurrencyQuotationData(array $requestData, HttpResponse $httpResponse): stdClass
    {
        $currencyExchangeSettings = app(CurrencyExchangeSettingsService::class)->getSettings();
        $currencyQuotationData = (object) Arr::first($httpResponse->json());

        $currencyQuotationData->conversion_value = $requestData['conversion_value'];
        $currencyQuotationData->payment_type = $requestData['payment_type'];

        $currencyQuotationData->payment_tax = $requestData['conversion_value']
            * $currencyExchangeSettings->getPaymentTax(PaymentType::from($requestData['payment_type']));

        $currencyQuotationData->conversion_tax = $requestData['conversion_value']
            * $currencyExchangeSettings->getConversionTax($requestData['conversion_value']);

        $currencyQuotationData->liquid_conversion_value = $requestData['conversion_value']
            - $currencyQuotationData->payment_tax - $currencyQuotationData->conversion_tax;

        $currencyQuotationData->destination_currency_liquid_conversion_value =
            $currencyQuotationData->liquid_conversion_value * $currencyQuotationData->bid;

        return $currencyQuotationData;
    }

    public function sendCurrencyExchangeMail(\stdClass $currencyQuotation): void {
        try {
            Mail::to(request()->user())
                ->send(
                    (new CurrencyExchangedMail($currencyQuotation))
                );
        } catch(\Exception $exception) {
            logger()->error($exception->getMessage());
            request()->session()->flash('error', $exception->getMessage());
        }
    }
}

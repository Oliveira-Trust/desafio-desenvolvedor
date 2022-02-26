<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Tax;
use App\Models\Quote;
use App\Exceptions\TaxNotFound;
use App\Repositories\RepositoryTax;
use App\Repositories\RepositoryQuote;
use App\Exceptions\QuoteNotFoundException;
use Illuminate\Database\Eloquent\Collection;

class QuoteService
{
    /**
     * @var RepositoryTax $repositoryTax
     */
    private $repositoryTax;

    /**
     * @var RepositoryTax $repositoryTax
     */
    private $repositoryQuote;

    /**
     * @var AwesomeService $awesomeService
     */
    private $awesomeService;

    /**
     * @var MailService $mailService
     */
    private $mailService;

    /**
     * @param RepositoryTax $repositoryTax
     * @param RepositoryQuote $repositoryQuote
     * @param AwesomeService $awesomeService
     */
    public function __construct(
        RepositoryTax $repositoryTax,
        RepositoryQuote $repositoryQuote,
        AwesomeService $awesomeService,
        MailService $mailService
    )
    {
        $this->repositoryTax = $repositoryTax;
        $this->repositoryQuote = $repositoryQuote;
        $this->awesomeService = $awesomeService;
        $this->mailService = $mailService;
    }

    /**
     * @param array $data
     * @return \App\Models\Quote
     */
    public function quote(array $data)
    {
        $res = $this->awesomeService->getQuote($data['codein']);

        $dataTransformer = $this->map($res["BRL{$data['codein']}"], $data);

        $quote = $this->repositoryQuote->save($dataTransformer);

        return $this->transformer(Collection::make([$quote]))[0];
    }

    /**
     * @return Collection
     */
    public function getQuotes()
    {
        $quotes = $this->repositoryQuote->get();

        return $this->transformer($quotes);
    }

    /**
     * @param string $code
     * @return array
     */
    public function getQuotesByPeriod(string $code)
    {
        return $this->awesomeService->getQuotesByPeriod($code);
    }

    /**
     * @param int $quoteID
     * @return User
     */
    public function sendMail(int $quoteID)
    {
        $quote = $this->repositoryQuote->find($quoteID);

        if (! $quote instanceof Quote)
            throw new QuoteNotFoundException(trans('exception.quoteNotFound'));

        $dataTransformer = $this->transformer(Collection::make([$quote]))[0];

        $this->mailService->sendMailQuote($dataTransformer, [
            'toMail' => $quote->user
        ]);

        return $quote->user;
    }

    /**
     * @param array $res
     * @param array $data
     * @return array
     * @throw TaxNotFound
     */
    private function map(array $res, array $data)
    {
        $tax = $this->getTax($data['payment_method']);

        $dataMap['code'] = $res['code'];
        $dataMap['codein'] = $res['codein'];
        $dataMap['conversion_value'] = $data['conversion_value'];
        $dataMap['payment_method'] = $tax->paymentMethod->name;
        $dataMap['tax'] = $tax->tax;
        $dataMap['payment_rate'] = $dataMap['conversion_value'] * ($tax->tax / 100);
        $dataMap['conversion_rate'] = $this->applyConversionRate($dataMap['conversion_value']);
        $dataMap['conversion_value_tax'] = $this->applyConversionValueTax($dataMap);
        $dataMap['purchased_value'] = $dataMap['conversion_value_tax'] * $res['bid'];
        $dataMap['destination_currency_value'] = $data['conversion_value'] / ($dataMap['conversion_value'] * $res['bid']);

        return $dataMap;
    }

    /**
     * @param Collection $quotes
     */
    private function transformer(Collection $quotes)
    {
        return $quotes->map(function ($quote) {
            return (object) [
                'id' => $quote['id'],
                'code' => $quote['code'],
                'code_in' => $quote['code_in'],
                'conversion_value' => money($quote['conversion_value']),
                'payment_method' => mb_strtoupper($quote['payment_method'], 'UTF-8'),
                'tax' => $quote['tax'],
                'payment_rate' => money($quote['payment_rate']),
                'conversion_rate' => money($quote['conversion_rate']),
                'conversion_value_tax' => money($quote['conversion_value_tax']),
                'purchased_value' => money($quote['purchased_value'], $quote['code_in']),
                'destination_currency_value' => money($quote['destination_currency_value']),
                'created_at' => Carbon::parse($quote['created_at'])->format('d/m/Y H:i:s')
            ];
        });
    }

    /**
     * @param string $paymentMethod
     * @return Tax
     * @throw TaxNotFound
     */
    private function getTax($paymentMethod)
    {
        $tax = $this->repositoryTax->find($paymentMethod);

        if (! $tax instanceof Tax)
            throw new TaxNotFound(trans('exception.taxNotFound'), 404);

        return $tax;
    }

    /**
     * @param mixed $purchaseValue
     * @return float
     */
    private function applyConversionRate($purchaseValue)
    {
        if ($purchaseValue <= 3000)
            return $purchaseValue * (2 / 100);

        return $purchaseValue * (1 / 100);
    }

    /**
     * @param array $dataTransformer
     * @return float
     */
    private function applyConversionValueTax(array $dataTransformer)
    {
        return $dataTransformer['conversion_value'] - ($dataTransformer['payment_rate'] + $dataTransformer['conversion_rate']);
    }
}
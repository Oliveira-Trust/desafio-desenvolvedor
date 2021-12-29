<?php

declare(strict_types=1);

namespace App\Domain\UseCases\Currency;

use App\Domain\Contracts\Http\HttpRequestInterface;
use App\Domain\Contracts\Repository\CurrencyRepositoryInterface;
use App\Domain\Entities\Currency;

class GetAllCurrency
{
    private $http;
    private $repository;

    public function __construct(HttpRequestInterface $http, CurrencyRepositoryInterface $repository)
    {
        $this->http = $http;
        $this->repository = $repository;
    }
    public function execute(): array
    {
        $currencies = $this->repository->getAll();
        $response = [];
        if(count($currencies) > 0 ) {
            foreach($currencies as $currency){
                $response[] = $currency->toArray();
            }   
            return $response;
        }
        $currencies = $this->http->request();
        $codes = '';
        foreach($currencies as $key => $currency) {
            $siglaArray = explode('-', $key);
            if($siglaArray[0] === 'BRL') {
                $codes .= $siglaArray[0] . '-' . $siglaArray[1] . ',';
            }
        }
        $this->http->setUrlRequest(env('API_ECONOMIA_BRL'));
        $codes = substr($codes, 0, -1);
        $currenciesBRL = $this->http->request($codes);        
        foreach($currenciesBRL as $currencyBRL) {
            $currency = new Currency();
            $currency->setCode($currencyBRL->code);
            $currency->setCodein($currencyBRL->codein);
            $currency->setName($currencyBRL->name);
            $currency->setSalePrice((float) $currencyBRL->bid);
            $currency->setPurchasePrice((float)$currencyBRL->ask);
            $this->repository->save($currency);
            $response[] = $currency->toArray();
        }
        return $response;
    }
}
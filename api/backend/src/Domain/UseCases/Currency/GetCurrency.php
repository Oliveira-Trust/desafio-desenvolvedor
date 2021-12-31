<?php

declare(strict_types=1);

namespace App\Domain\UseCases\Currency;

use App\Domain\Contracts\Http\HttpRequestInterface;
use App\Domain\Contracts\Repository\CurrencyRepositoryInterface;
use App\Domain\Entities\Currency;

class GetCurrency
{
    private $http;
    private $repository;

    public function __construct(HttpRequestInterface $http, CurrencyRepositoryInterface $repository)
    {
        $this->http = $http;
        $this->repository = $repository;
    }
    public function execute($code): array
    {
        if(is_numeric($code)) {
            $currency = $this->repository->getById((int)$code);
            if(!$currency){
                throw new \Exception("Not result to code $code");
            }
            return $currency->toArray();
        }
        if(is_string($code)) {
            $currency = $this->repository->getByCurrencyCode($code);
            if($currency) {
                return $currency->toArray();
            } else {
                $this->http->setUrlRequest(env('API_ECONOMIA_BRL_UNIQ'));
                $response = $this->http->request($code);
                if($response->status === 404) {
                    throw new \Exception("Not result to code $code");
                }
                foreach($response as $item){
                    $currency = new Currency();
                    $currency->setCode($item->code);
                    $currency->setCodein($item->codein);
                    $currency->setName($item->name);
                    $currency->setSalePrice((float) $item->bid);
                    $currency->setPurchasePrice((float)$item->ask);
                    $this->repository->save($currency);
                    $response = $currency->toArray();
                }
            }
        }
        return $response;
    }
}
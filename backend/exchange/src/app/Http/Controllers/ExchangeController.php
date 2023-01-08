<?php

namespace App\Http\Controllers;

use App\Contracts\CurrencyRepositoryInterface;
use App\Contracts\ExchangeRepositoryInterface;
use App\Http\Requests\CreateExchangeRequest;
use App\Models\Currency;
use App\Services\CreateExchangeService;
use Cache;

class ExchangeController extends Controller {

    const CACHE_KEY_PREFIX         = 'exchange-';
    const CACHE_KEY_ALL            = 'exchange-all';
    const CACHE_KEY_BY_USER_PREFIX = 'exchange-by_user-';

    public function __construct(
        private ExchangeRepositoryInterface $exchange_repository,
        private CurrencyRepositoryInterface $currency_repository,
    ) {
    }

    public function index() {

        $cached_response = Cache::remember(self::CACHE_KEY_ALL, now()->addDay(), function() {
            return $this->exchange_repository->getAll(
                relations: [
                    'paymentMethod',
                    'originCurrency',
                    'destinationCurrency',
                ]
            );
        });

        return $this->successResponse($cached_response);
    }

    public function indexByUserId($user_id) {

        $cached_response = Cache::remember(self::CACHE_KEY_BY_USER_PREFIX . $user_id, now()->addDay(), function() use ($user_id) {
            return $this->exchange_repository->getAllByUserId(
                user_id: $user_id,
                relations: [
                    'paymentMethod',
                    'originCurrency',
                    'destinationCurrency',
                ]
            );
        }
        );

        return $this->successResponse($cached_response);
    }

    public function showByUserId($user_id, $exchange_id) {

        $cached_response = Cache::remember(self::CACHE_KEY_PREFIX . $exchange_id, now()->addDay(), function() use ($user_id) {
            return $this->exchange_repository->getAllByUserId(
                user_id: $user_id,
                relations: [
                    'paymentMethod',
                    'originCurrency',
                    'destinationCurrency',
                ]
            );
        });

        return $this->successResponse($cached_response);
    }

    public function show($exchange_id) {

        $cached_response = Cache::remember(self::CACHE_KEY_PREFIX . $exchange_id, now()->addDay(), function() use ($exchange_id) {
            return $this->exchange_repository->findOrFail(
                id: $exchange_id,
                relations: [
                    'paymentMethod',
                    'originCurrency',
                    'destinationCurrency',
                ]
            );
        });

        return $this->successResponse($cached_response);
    }

    public function create(CreateExchangeRequest $request) {

        $result = (new CreateExchangeService(
            user_id: $request->input('user_id'),
            origin_value: $request->input('origin_value'),
            payment_method_id: $request->input('payment_method_id'),
            origin_currency_id: $this->currency_repository->findOrFailByCode(Currency::DEFAULT_ORIGIN_CURRENCY_CODE)->id,
            destination_currency_id: $request->input('destination_currency_id'),
            email: $request->input('email')
        ))->execute();

        Cache::deleteMultiple([self::CACHE_KEY_ALL, self::CACHE_KEY_BY_USER_PREFIX . $request->input('user_id')]);

        $cached_response = Cache::remember(self::CACHE_KEY_PREFIX . $result->id, now()->addDay(), function() use ($result) {
            return $this->exchange_repository->findOrFail(
                id: $result->id,
                relations: [
                    'paymentMethod',
                    'originCurrency',
                    'destinationCurrency',
                ]
            );
        });

        return $this->successResponse($cached_response, 201);
    }
}

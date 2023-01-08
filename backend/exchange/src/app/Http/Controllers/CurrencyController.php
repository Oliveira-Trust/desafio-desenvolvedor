<?php

namespace App\Http\Controllers;

use App\Contracts\CurrencyRepositoryInterface;
use Cache;

class CurrencyController extends Controller {

    public function __construct(private CurrencyRepositoryInterface $currency_repository) { }

    public function index() {
        $cached_response = Cache::remember('currencies', now()->addDay(), function() {
            return $this->currency_repository->getAll();
        });
        return $this->successResponse($cached_response);

    }
}

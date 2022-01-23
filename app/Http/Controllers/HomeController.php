<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use AwesomeApi\Services\AwesomeApiService;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    private AwesomeApiService $awesomeApiService;

    public function __construct(AwesomeApiService $awesomeApiService)
    {
        $this->awesomeApiService = $awesomeApiService;
    }

    public function index(): Renderable
    {
        $currencies = $this->awesomeApiService->currenciesAvailable();

        return view('home')->with('data', $currencies);
    }

    public function quoteHistory(): Renderable
    {
        return view('quote-history');
    }
}

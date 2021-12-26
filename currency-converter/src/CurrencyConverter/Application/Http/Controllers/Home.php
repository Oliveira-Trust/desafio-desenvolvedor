<?php

namespace CurrencyConverter\Application\Http\Controllers;

use CurrencyConverter\Domain\Currency\Services\CurrencyService;
use Illuminate\Contracts\Support\Renderable;

/**
 * Class Home
 * @package CurrencyConverter\Application\Http\Controllers
 * @author Tiago O. de Farias <tiago.farias.poa@gmail.com>
 */
class Home extends Controller
{
    private CurrencyService $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $availablesCombinations = $this->service->listAvailablesCombinations();

        return view('home', compact('availablesCombinations'));
    }
}

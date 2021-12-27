<?php

namespace CurrencyConverter\Application\Http\Controllers;

use CurrencyConverter\Domain\Currency\Services\CurrencyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

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
     * @param CurrencyService $service
     */
    public function __construct(CurrencyService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function index(Request $request)
    {
        $availablesCombinations = $this->service->listAvailablesCombinations();

        if ($request->isMethod('post'))
        {
            $request->validate([
                'destiny_currency' => 'required|string',
                'value_for_conversion' => 'required|numeric|min:1000|max:100000',
                'payment_method' => 'required|in:1,2',
            ]);
            $request->flash();
        }

        return view('home', compact('availablesCombinations'));
    }
}

<?php

namespace CurrencyConverter\Application\Http\Controllers;

use CurrencyConverter\Domain\Currency\Services\CurrencyService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

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
     * @return Application|Factory|View
     */
    public function index()
    {
        $availablesCombinations = $this->service->listAvailablesCombinations();

        return view('home', compact('availablesCombinations'));
    }

    /**
     * @param Request $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function convert(Request $request)
    {
        $request->validate([
            'destiny_currency' => 'required|string',
            'value_for_conversion' => 'required|numeric|min:1000|max:100000',
            'payment_method' => 'required|in:1,2',
        ]);

        return redirect('home')->withInput($request->all());
    }
}

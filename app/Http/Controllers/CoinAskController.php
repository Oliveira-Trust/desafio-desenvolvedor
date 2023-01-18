<?php

namespace App\Http\Controllers;

use App\Models\CoinAsk;
use Illuminate\Http\Request;

/**
 * Class CoinAskController
 * @package App\Http\Controllers
 */
class CoinAskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coinAsks = CoinAsk::paginate();

        return view('coin-ask.index', compact('coinAsks'))
            ->with('i', (request()->input('page', 1) - 1) * $coinAsks->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coinAsk = new CoinAsk();
        return view('coin-ask.create', compact('coinAsk'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(CoinAsk::$rules);

        $coinAsk = CoinAsk::create($request->all());

        return redirect()->route('coin-asks.index')
            ->with('success', 'CoinAsk created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coinAsk = CoinAsk::find($id);

        return view('coin-ask.show', compact('coinAsk'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coinAsk = CoinAsk::find($id);

        return view('coin-ask.edit', compact('coinAsk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CoinAsk $coinAsk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CoinAsk $coinAsk)
    {
        request()->validate(CoinAsk::$rules);

        $coinAsk->update($request->all());

        return redirect()->route('coin-asks.index')
            ->with('success', 'CoinAsk updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $coinAsk = CoinAsk::find($id)->delete();

        return redirect()->route('coin-asks.index')
            ->with('success', 'CoinAsk deleted successfully');
    }
}

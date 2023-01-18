<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;

/**
 * Class CoinController
 * @package App\Http\Controllers
 */
class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coins = Coin::paginate();

        return view('coin.index', compact('coins'))
            ->with('i', (request()->input('page', 1) - 1) * $coins->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $coin = new Coin();
        return view('coin.create', compact('coin'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Coin::$rules);

        $coin = Coin::create($request->all());

        return redirect()->route('coins.index')
            ->with('success', 'Coin created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coin = Coin::find($id);

        return view('coin.show', compact('coin'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coin = Coin::find($id);

        return view('coin.edit', compact('coin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Coin $coin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coin $coin)
    {
        request()->validate(Coin::$rules);

        $coin->update($request->all());

        return redirect()->route('coins.index')
            ->with('success', 'Coin updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $coin = Coin::find($id)->delete();

        return redirect()->route('coins.index')
            ->with('success', 'Coin deleted successfully');
    }
}

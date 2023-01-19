<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

/**
 * Class ConfigController
 * @package App\Http\Controllers
 */
class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configs = Config::paginate();

        return view('config.index', compact('configs'))
            ->with('i', (request()->input('page', 1) - 1) * $configs->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $config = new Config();
        return view('config.create', compact('config'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Config::$rules);

        $config = Config::create($request->all());

        return redirect()->route('configs.index')
            ->with('success', 'Config created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $config = Config::find($id);

        return view('config.show', compact('config'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $config = Config::find($id);

        return view('config.edit', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Config $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Config $config)
    {
        request()->validate(Config::$rules);

        $config->update($request->all());

        return redirect()->route('configs.index')
            ->with('success', 'Config updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $config = Config::find($id)->delete();

        return redirect()->route('configs.index')
            ->with('success', 'Config deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\Condicoes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\condico;
use Illuminate\Http\Request;

class condicoesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $condicoes = condico::where('condicoes', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $condicoes = condico::latest()->paginate($perPage);
        }

        return view('condicoes.index', compact('condicoes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('condicoes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        condico::create($requestData);

        return redirect('admin/condicoes')->with('flash_message', 'condico added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $condico = condico::findOrFail($id);

        return view('condicoes.show', compact('condico'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $condico = condico::findOrFail($id);

        return view('condicoes.edit', compact('condico'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $condico = condico::findOrFail($id);
        $condico->update($requestData);

        return redirect('admin/condicoes')->with('flash_message', 'condico updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        condico::destroy($id);

        return redirect('admin/condicoes')->with('flash_message', 'condico deleted!');
    }
}

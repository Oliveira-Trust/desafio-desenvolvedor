<?php

namespace App\Http\Controllers\Produtos;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\produto;
use Illuminate\Http\Request;

class produtosController extends Controller
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
            $produtos = produto::where('produto_nome', 'LIKE', "%$keyword%")
                ->orWhere('produto_val', 'LIKE', "%$keyword%")
                ->orWhere('produto_forn', 'LIKE', "%$keyword%")
                ->orWhere('produto_cont', 'LIKE', "%$keyword%")
                ->orWhere('produto_preco', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $produtos = produto::latest()->paginate($perPage);
        }

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('produtos.create');
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
        
        produto::create($requestData);

        return redirect('admin/produtos')->with('flash_message', 'produto added!');
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
        $produto = produto::findOrFail($id);

        return view('produtos.show', compact('produto'));
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
        $produto = produto::findOrFail($id);

        return view('produtos.edit', compact('produto'));
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
        
        $produto = produto::findOrFail($id);
        $produto->update($requestData);

        return redirect('admin/produtos')->with('flash_message', 'produto updated!');
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
        produto::destroy($id);

        return redirect('admin/produtos')->with('flash_message', 'produto deleted!');
    }
}

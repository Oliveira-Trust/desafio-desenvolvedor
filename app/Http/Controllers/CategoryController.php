<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Exibe a listagem de categorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.categorias.index');
    }

    /**
     * Exibe a página de criação de categorias.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categorias.create');
    }

    /**
     *  Cadastra uma nova categoria.
     *
     * @param  CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->only('name', 'label'));
        return response()->json([ 'status' => true, 'message' => 'Registro adicionado com sucesso!'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    

    /**
     * Pesquisa e pagina os registros de categorias.
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request){
        return Category::with('product')->paginate(10);
    }
}

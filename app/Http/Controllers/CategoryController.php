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
     * Exibe a página para editar a categoria.
     *
     * @param  Category  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $categoria)
    {
        return view('admin.categorias.edit', compact( 'categoria'));
    }

    /**
     * Atualiza uma categoria.
     *
     * @param  CategoryRequest  $request
     * @param  Category  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $categoria)
    {
        $categoria->update($request->only('name', 'label'));
        return response()->json([ 'status' => true, 'message' => 'Registro atualizado com sucesso!'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $categoria)
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

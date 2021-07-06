<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * Exibe a listagem de produtos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.produtos.index');
    }

    /**
     * Exibe a página de criação de produtos.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.produtos.create', compact('categories'));
    }

    /**
     * Cadastra um novo produto.
     *
     * @param  ProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Product::create($request->only('name', 'label', 'category_id', 'value', 'description', 'enabled'));
        return response()->json([ 'status' => true, 'message' => 'Registro adicionado com sucesso!'], 200);
    }

    /**
     * Exibe a página para editar o produto.
     *
     * @param  Product  $produto
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $produto)
    {
        $categories = Category::all();
        return view('admin.produtos.edit', compact('produto', 'categories'));
    }

    /**
     * Atualiza um produto.
     *
     * @param  ProductRequest  $request
     * @param  Product $produto
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $produto)
    {
        $produto->update($request->only('name', 'label', 'category_id', 'value', 'description', 'enabled'));  
        return response()->json([ 'status' => true, 'message' => 'Registro atualizado com sucesso!'], 200);
    }

    /**
     * Remove um produto.
     *
     * @param  Product $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $produto)
    {
        $produto->delete();
        return response()->json([ 'status' => true, 'message' => 'Registro deletado com sucesso!'], 200);
    }


    

    /**
     * Pesquisa e pagina os registros de produtos.
     *
     * @param Request $request
     * @return void
     */
    public function search(Request $request, ProductRepository $model){
        return $model->search($request->all());
    }



    public function deleteInMass(Request $request){
        try {
            Product::whereIn('id', $request->items)->delete();
            return response()->json([ 'status' => true, 'message' => count($request->items) > 1 ? 'Registros deletados com sucesso!' : 'Registro deletado com sucesso!'], 200);
        } catch (\Throwable $th) {
            return response()->json([ 'status' => false, 'message' => 'Erro ao deletar os registros.', 'th' =>  $th], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Grid\GridManagement;
use App\Models\Products;
use Illuminate\Http\Request;
use Okipa\LaravelTable\Table as OkipaTable;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $table = GridManagement::productsGrid();

        return view('Lists.productsList')->with('table',$table);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Forms.productForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prodSave = new Products();
        $savedReturn = $prodSave->saveProducts($request);
        return view('Forms.productForm')->with(compact('savedReturn'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product =  Products::find($id);
        return view('Forms.productForm')->with(compact('product'));
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
        $products = new Products();
        $product = $products->find($id);
        if($product->delete()){
            return redirect('produtos')->with("success","Produto Deletado com sucesso");
        }
        return redirect('produtos')->with("success","Produto  não Deletado");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

   public function __construct(ProductService $productService)
   {
       $this->productService = $productService;
   }

    public function show($id)
    {
        //retorna view
    }

    public function index()
    {
        return $this->productService->all();
    }

    public function create()
    {
        //retorna view
    }

    //todo adicionar validaçãp de request
    public function store(Request $request)
    {
        $this->productService->save($request);
    }

    public function edit($id)
    {

    }

    //todo adicionar validaçãp de request
    public function update(Request $request, $id)
    {
        return $this->productService->update($id, $request);
    }

    public function destroy($id)
    {
        $destroidItem = $this->productService->destroy($id);

        if (!$destroidItem) return "item não encontrado";

        return "item deleteado";
    }
}

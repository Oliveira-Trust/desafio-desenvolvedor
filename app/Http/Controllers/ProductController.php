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

    }

    public function index()
    {
        return $this->productService->all();
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        return $this->productService->save($request->all());
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {
        return $this->productService->update($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->productService->destroy($id);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
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
        $product = $this->productService->find($id);
        return view('product.show')->with(["product" => $product]);
    }

    public function index()
    {
        $products = $this->productService->all();
        return view('product.index')->with(["products" => $products]);
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $this->productService->save($request->all());
        return redirect('products');
    }

    public function edit($id)
    {
        $product = $this->productService->find($id);
        return view('product.edit')->with(["product" => $product]);
    }

    public function update(Request $request, $id)
    {
        $this->productService->update($request->all(), $id);
        return redirect('products');
    }

    public function destroy($id)
    {
        $this->productService->destroy($id);
        return redirect('products');
    }

    public function find($id)
    {
        return $this->productService->find((int) $id);
    }
}

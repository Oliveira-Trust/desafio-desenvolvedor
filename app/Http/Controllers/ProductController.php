<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }
    public function create()
    {
        return view('product.create');
    }
    public function store()
    {
        Product::query()->create(request()->all());
        return redirect()->route('index_product');
    }
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }
    public function update(Product $product)
    {
        Product::query()->where('id', $product->id)->update(request()
            ->only('name', 'price'));
        return redirect()->route('index_product');
    }
    public function destroy(Product $product)
    {
        Product::query()->where('id', $product->id)->delete();
        return redirect()->route('index_product');
    }
}

<?php

namespace App\Http\Controllers;

use App\Filters\ProductFilters;
use App\Http\Requests\StoreProduct;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ProductFilters $productFilters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(ProductFilters $productFilters)
    {
        $products = Product::select('id', 'name', 'price')
            ->filter($productFilters)
            ->orderBy('name')
            ->paginate(10);
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return ProductResource
     */
    public function store(StoreProduct $request)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->price = str_replace(',', '.', $request->input('price'));
        $product->obs = $request->input('obs');
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return ProductResource
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product $product
     * @return ProductResource
     */
    public function update(Request $request, Product $product)
    {
        $product->name = $request->input('name');
        $product->price = str_replace(',', '.', $request->input('price'));
        $product->obs = $request->input('obs');
        $product->save();
        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
    }
}

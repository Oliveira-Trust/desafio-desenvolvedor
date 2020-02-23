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
     * @param Request $request
     * @param ProductFilters $productFilters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request, ProductFilters $productFilters)
    {
        $results = Product::select('id', 'name', 'price')
            ->filter($productFilters)
            ->orderBy($request->input('order','id'))
            ->paginate(10);
        if ($request->wantsJson()) {
            return ProductResource::collection($results);
        }
        return view('product.index')->with(compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.form');
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
     * @param Request $request
     * @param \App\Product $product
     * @return ProductResource
     */
    public function show(Request $request, Product $product)
    {
        if ($request->wantsJson()) {
            return new ProductResource($product);
        }
        return view('product.show')->with(compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        return view('product.form')->with(compact('product'));
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json('Removido com sucesso!', 200);
    }
}

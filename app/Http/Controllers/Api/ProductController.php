<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Product;
use App\Repository\ProductRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $productRepository = new ProductRepository($this->product);

            if($request->has("coditions")) {
                $productRepository->selectCoditions($request->coditions);
            }

            if($request->has("fields")) {
                $productRepository->selectFilter($request->fields);
            }

            return new ProductCollection($productRepository->getResult()->paginate(10));

        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        try {
            $this->product->create($request->all());

            $message = new ApiMessages("Product sucessfully created");

            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $product = $this->product->findOrFail($id);

            return new ProductResource($product);
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
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
        try {
            $productRepository = new ProductRepository($this->product);

            if($productRepository->validationUpdate($request, $id)) {
                $product = $this->product->findOrFail($id);
                $product->update($request->all());
            }

            $message = new ApiMessages("Product sucessfully updated");
            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $ids = explode(',', $id);
            $this->product->findOrFail($ids)->each(function($p, $key){
                $p->delete();
            });
            

            $message = new ApiMessages("Product sucessfully removed");
            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}

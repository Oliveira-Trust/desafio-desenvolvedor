<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repository\Product\ProductDTO;
use App\Repository\Product\ProductIRepository;

class ProductController extends Controller
{
    private $productIRepository;

    public function __construct(
        ProductIRepository $productIRepository
    )
    {
        $this->productIRepository = $productIRepository;
        $this->middleware('auth:api');
    }

    public function index(Request $request) {
        return $this->productIRepository->readAll();
    }

    public function show(Request $request, $id) {
        $product = $this->productIRepository->read($id);

        if ($product === []) {
            return response()->json( [
                "message" => "Not found."
            ], 404);
        }

        return $product;
    }

    public function store(Request $request) {

        //validate incoming request
        $this->validate($request, ProductDTO::rules());

        try
        {
            $product = new ProductDTO($request->all());
            $this->productIRepository->create($product);

            return response()->json( [
                'entity' => 'product',
                'action' => 'store',
                'result' => 'success'
            ], 201);

        }
        catch (\Exception $e)
        {
            return response()->json( [
                'entity' => 'product',
                'action' => 'store',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }

    public function update(Request $request, $id) {
        $product = $this->productIRepository->read($id);

        if ($product === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        $this->validate($request, ProductDTO::rulesUpdate($id));

        try {
            $productDTO = new ProductDTO($request->all());
            $productUpdated = $this->productIRepository->update($id, $productDTO);

            if ($productUpdated == $product) {
                return response()->json( [
                    "message" => "Nothing to change."
                ], 400);
            }

            return response()->json( $productUpdated, 200);

        } catch (\Exception $e) {
            return response()->json( [
                'entity' => 'product',
                'action' => 'update',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }


    public function delete(Request $request, $id) {
        $product = $this->productIRepository->read($id);

        if ($product === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        if ($this->productIRepository->delete($id)) {
            return response()->json( ["message" => "success"], 200);
        }
        return response()->json( ["message" => "Error"], 400);
    }
}

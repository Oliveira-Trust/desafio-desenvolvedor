<?php

namespace App\Http\Controllers\API;

use App\Response\JsonResponse;
use Illuminate\Routing\Controller;
use App\Http\Requests\ProductRequest;
use App\Repositories\ProductRepository;

class ProductController extends Controller
{
    /**
     * Access to User Repository
     */
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->middleware('auth:api');
        $this->productRepository = $productRepository;
    }

    /**
     * Show the Product list
     *
     * @return JsonResponse
     */
    public function index()
    {
        return JsonResponse::success(
            true, 
            'Product.index', 
            $this->productRepository->all()->toArray()
        );
    }

    /**
     * Show the Product item.
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        return JsonResponse::success(
            true, 
            'Product.show', 
            $this->productRepository->getById($id)->toArray()
        );
    }
    
    /**
     * Create a Product item.
     *
     * @return JsonResponse
     */
    public function store(ProductRequest $request)
    {
        $validFields = $request->validated();
        try {
            return $this->productRepository->create($validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Update a Product item.
     *
     * @return JsonResponse
     */
    public function update($id, ProductRequest $request)
    {
        $validFields = $request->validated();
        try {
            return $this->productRepository->update($id, $validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Delete a Product item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            return $this->productRepository->delete($id);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
}

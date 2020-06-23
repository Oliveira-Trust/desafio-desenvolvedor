<?php

namespace App\Http\Controllers;

use App\Response\JsonResponse;
use App\DataTables\ProductDataTable;
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
        $this->middleware('auth');
        $this->productRepository = $productRepository;
    }

    /**
     * Show the Product table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(ProductDataTable $dataTable)
    {
        $statuses = $this->productRepository->getProductStatuses();
        $images = $this->productRepository->getProductImages();
        return $dataTable->render('painel.product.index', [
            'statuses' => $statuses,
            'images' => $images
        ]);
    }

    /**
     * Show the Product table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allData()
    {
        return $this->productRepository->all();
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
            '', 
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
        return $this->productRepository->create($validFields);
    }
    
    /**
     * Update a Product item.
     *
     * @return JsonResponse
     */
    public function update($id, ProductRequest $request)
    {
        $validFields = $request->validated();
        return $this->productRepository->update($id, $validFields);
    }
    
    /**
     * Delete a Product item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }
}

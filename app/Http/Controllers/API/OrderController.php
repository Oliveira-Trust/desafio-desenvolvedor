<?php

namespace App\Http\Controllers\API;

use App\Response\JsonResponse;
use Illuminate\Routing\Controller;
use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{
    /**
     * Access to User Repository
     */
    protected $orderRepository;
    protected $clientRepository;
    protected $productRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->middleware('auth:api');
        $this->orderRepository = $orderRepository;
    }

    /**
     * Show the Order list
     *
     * @return JsonResponse
     */
    public function index()
    {
        return JsonResponse::success(
            true, 
            'order.index', 
            $this->orderRepository->all()->toArray()
        );
    }

    /**
     * Show the Order item.
     *
     * @return JsonResponse
     */
    public function show($id)
    {
        return JsonResponse::success(
            true, 
            'order.show', 
            $this->orderRepository->getById($id)->toArray()
        );
    }
    
    /**
     * Create a Order item.
     *
     * @return JsonResponse
     */
    public function store(OrderRequest $request)
    {
        $validFields = $request->validated();
        try {
            return $this->orderRepository->create($validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Update a Order item.
     *
     * @return JsonResponse
     */
    public function update($id, OrderRequest $request)
    {
        $validFields = $request->validated();
        try {
            return $this->orderRepository->update($id, $validFields);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
    
    /**
     * Delete a Order item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        try {
            return $this->orderRepository->delete($id);
        } catch (Exception $exception) {
            return JsonResponse::success(
                false, 
                $exception->getMessage(), 
                []
            );
        }
    }
}

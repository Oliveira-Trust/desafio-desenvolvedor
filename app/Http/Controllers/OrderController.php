<?php

namespace App\Http\Controllers;

use App\Response\JsonResponse;
use App\DataTables\OrderDataTable;
use App\Http\Requests\OrderRequest;
use App\Repositories\OrderRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;

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
        $this->middleware('auth');
        $this->orderRepository = $orderRepository;
        $this->clientRepository = app(ClientRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * Show the Order table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(OrderDataTable $dataTable)
    {
        $statuses = $this->orderRepository->getOrderStatuses();
        $clients = $this->clientRepository->all()
            ->where('status.status', 1)
            ->sortBy('name');
        $products = $this->productRepository->all()
            ->where('status.status', 1)
            ->sortBy('name');
        return $dataTable->render('painel.order.index', [
            'statuses' => $statuses,
            'clients' => $clients,
            'products' => $products
        ]);
    }

    /**
     * Show the Order table.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function allData()
    {
        return $this->orderRepository->all();
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
            '', 
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
        return $this->orderRepository->create($validFields);
    }
    
    /**
     * Update a Order item.
     *
     * @return JsonResponse
     */
    public function update($id, OrderRequest $request)
    {
        $validFields = $request->validated();
        return $this->orderRepository->update($id, $validFields);
    }
    
    /**
     * Delete a Order item.
     *
     * @return JsonResponse
     */
    public function delete($id)
    {
        return $this->orderRepository->delete($id);
    }
}

<?php

namespace App\Http\Controllers;

use Flash;
use Response;
use App\Models\Order;
use App\Http\Requests;
use App\DataTables\OrderDataTable;
use App\Repositories\OrderRepository;
use App\Repositories\ClientRepository;
use App\Repositories\ProductRepository;
use App\Http\Requests\CreateOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Controllers\AppBaseController;

class OrderController extends AppBaseController
{
    /** @var  OrderRepository */
    private $orderRepository;
    private $clientRepository;
    private $productRepository;

    public function __construct(OrderRepository $orderRepo)
    {
        $this->orderRepository = $orderRepo;
        $this->clientRepository = app(ClientRepository::class);
        $this->productRepository = app(ProductRepository::class);
    }

    /**
     * Display a listing of the Order.
     *
     * @param OrderDataTable $orderDataTable
     * @return Response
     */
    public function index(OrderDataTable $orderDataTable)
    {
        return $orderDataTable->render('orders.index');
    }

    /**
     * Show the form for creating a new Order.
     *
     * @return Response
     */
    public function create()
    {
        $status = $this->orderRepository->filterByRef(Order::getTableName(), [
            'enable' => 1
        ])->pluck('name', 'id');
        $clients = $this->clientRepository->all()
            ->where('status.status', 1)
            ->sortBy('name')
            ->pluck('name', 'id');
        $products = $this->productRepository->all()
            ->where('status.status', 1)
            ->sortBy('name');

        return view('orders.create')
        ->with('clients', $clients)
        ->with('products', $products)
        ->with('statuses', $status);
    }

    /**
     * Store a newly created Order in storage.
     *
     * @param CreateOrderRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderRequest $request)
    {
        $input = $request->all();

        $order = $this->orderRepository->create($input);

        Flash::success('Order saved successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Display the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified Order.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $order = $this->orderRepository->find($id);
        $status = $this->orderRepository->filterByRef(Order::getTableName(), [
            'enable' => 1
        ])->pluck('name', 'id');
        $clients = $this->clientRepository->all()
            ->where('status.status', 1)
            ->sortBy('name')
            ->pluck('name', 'id');
        $products = $this->productRepository->all()
            ->where('status.status', 1)
            ->sortBy('name');

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        return view('orders.edit')
        ->with('clients', $clients)
        ->with('products', $products)
        ->with('statuses', $status)
        ->with('order', $order);
    }

    /**
     * Update the specified Order in storage.
     *
     * @param  int              $id
     * @param UpdateOrderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderRequest $request)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $order = $this->orderRepository->update($request->all(), $id);

        Flash::success('Order updated successfully.');

        return redirect(route('orders.index'));
    }

    /**
     * Remove the specified Order from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $order = $this->orderRepository->find($id);

        if (empty($order)) {
            Flash::error('Order not found');

            return redirect(route('orders.index'));
        }

        $this->orderRepository->delete($id);

        Flash::success('Order deleted successfully.');

        return redirect(route('orders.index'));
    }
}

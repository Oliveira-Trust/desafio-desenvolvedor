<?php

namespace App\Http\Controllers;

use App\DataTables\OrderProductsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateOrderProductsRequest;
use App\Http\Requests\UpdateOrderProductsRequest;
use App\Repositories\OrderProductsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class OrderProductsController extends AppBaseController
{
    /** @var  OrderProductsRepository */
    private $orderProductsRepository;

    public function __construct(OrderProductsRepository $orderProductsRepo)
    {
        $this->orderProductsRepository = $orderProductsRepo;
    }

    /**
     * Display a listing of the OrderProducts.
     *
     * @param OrderProductsDataTable $orderProductsDataTable
     * @return Response
     */
    public function index(OrderProductsDataTable $orderProductsDataTable)
    {
        return $orderProductsDataTable->render('order_products.index');
    }

    /**
     * Show the form for creating a new OrderProducts.
     *
     * @return Response
     */
    public function create()
    {
        return view('order_products.create');
    }

    /**
     * Store a newly created OrderProducts in storage.
     *
     * @param CreateOrderProductsRequest $request
     *
     * @return Response
     */
    public function store(CreateOrderProductsRequest $request)
    {
        $input = $request->all();

        $orderProducts = $this->orderProductsRepository->create($input);

        Flash::success('Order Products saved successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Display the specified OrderProducts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }

        return view('order_products.show')->with('orderProducts', $orderProducts);
    }

    /**
     * Show the form for editing the specified OrderProducts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }

        return view('order_products.edit')->with('orderProducts', $orderProducts);
    }

    /**
     * Update the specified OrderProducts in storage.
     *
     * @param  int              $id
     * @param UpdateOrderProductsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOrderProductsRequest $request)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }

        $orderProducts = $this->orderProductsRepository->update($request->all(), $id);

        Flash::success('Order Products updated successfully.');

        return redirect(route('orderProducts.index'));
    }

    /**
     * Remove the specified OrderProducts from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $orderProducts = $this->orderProductsRepository->find($id);

        if (empty($orderProducts)) {
            Flash::error('Order Products not found');

            return redirect(route('orderProducts.index'));
        }

        $this->orderProductsRepository->delete($id);

        Flash::success('Order Products deleted successfully.');

        return redirect(route('orderProducts.index'));
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Api\ApiMessages;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderCollection;
use App\Http\Resources\OrderResource;
use App\Order;
use App\Repository\OrderRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $orderRepository = new OrderRepository($this->order);

            if($request->has("coditions")) {
                $orderRepository->selectCoditions($request->coditions);
            }

            if($request->has("fields")) {
                $orderRepository->selectFilter($request->fields);
            }

            $orders = $orderRepository->getResult()
                            ->with(['user', 'product', 'orderStatus'])
                            ->paginate(10);

            return new OrderCollection($orders);

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
    public function store(OrderRequest $request)
    {
        try {
            $order = new OrderRepository($this->order);
            $order->storeOrder($request);

            $message = new ApiMessages("Order sucessfully created");
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
            $order = $this->order->findOrFail($id);

            return new OrderResource($order);
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
            $orderRepository = new OrderRepository($this->order);
            $orderRepository->updateOrder($request, $id);

            $message = new ApiMessages("Order sucessfully updated");
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
    public function destroy($idOrder, Request $request)
    {
        try {
            $orderRepository = new OrderRepository($this->order);
            if($orderRepository->validationRemoveProducts($request)) {
                $orderRepository->removeProductOrder($idOrder, $request->products_id);
            }
            
            $message = new ApiMessages("Order sucessfully updated");
            return response()->json($message->getMessage());
        } catch (QueryException $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 401);
        }
    }
}

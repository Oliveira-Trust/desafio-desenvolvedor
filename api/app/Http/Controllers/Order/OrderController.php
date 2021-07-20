<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repository\Order\OrderDTO;
use App\Repository\Order\OrderIRepository;

class OrderController extends Controller
{
    private $orderIRepository;

    public function __construct(
        OrderIRepository $orderIRepository
    )
    {
        $this->orderIRepository = $orderIRepository;
        $this->middleware('auth:api');
    }

    public function index(Request $request) {
        return $this->orderIRepository->readAll();
    }

    public function show(Request $request, $id) {
        $order = $this->orderIRepository->read($id);

        if ($order === []) {
            return response()->json( [
                "message" => "Not found."
            ], 404);
        }

        return $order;
    }

    public function store(Request $request) {

        //validate incoming request
        $this->validate($request, OrderDTO::rules());

        try
        {
            $order = new OrderDTO($request->all());
            $this->orderIRepository->create($order);

            return response()->json( [
                'entity' => 'order',
                'action' => 'store',
                'result' => 'success'
            ], 201);

        }
        catch (\Exception $e)
        {
            return response()->json( [
                'entity' => 'order',
                'action' => 'store',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }

    public function update(Request $request, $id) {
        $order = $this->orderIRepository->readClean($id);

        if ($order === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        $this->validate($request, OrderDTO::rulesUpdate($id));

        try {
            $orderDTO = new OrderDTO($request->all());
            $orderUpdated = $this->orderIRepository->update($id, $orderDTO);

            return response()->json( $orderUpdated, 200);

        } catch (\Exception $e) {
            return response()->json( [
                'entity' => 'order',
                'action' => 'update',
                'result' => 'failed'
                ,'error' => $e->getMessage()
            ], 409);
        }
    }


    public function delete(Request $request, $id) {
        $order = $this->orderIRepository->read($id);

        if ($order === []) {
            return response()->json( ["message" => "Not found."], 404);
        }

        if ($this->orderIRepository->delete($id)) {
            return response()->json( ["message" => "success"], 200);
        }
        return response()->json( ["message" => "Error"], 400);
    }

    public function deleteArray(Request $request) {

        if (!isset($request->ids) || count($request->ids) == 0) {
            return response()->json( ["message" => "Empty ids."], 422);
        }

        $categories = $this->orderIRepository->readArray($request->ids);

        if ($categories === []) {
            return response()->json( ["message" => "Not found."], 404);
        }
        $errorDelete = false;
        foreach ($categories as $order) {
            if (!$this->orderIRepository->delete($order['id'])) {
                $errorDelete = true;
            }
        }

        if ($errorDelete) return response()->json( ["message" => "Error"], 400);

        return response()->json( ["message" => "success"], 200);
    }
}

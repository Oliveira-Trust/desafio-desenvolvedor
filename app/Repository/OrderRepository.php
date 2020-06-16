<?php

namespace App\Repository;

use App\Order;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class OrderRepository extends AbstractRepository
{
    private function validationUpdate($request) 
    {
        return $request->validate([
            'order_condition'   => ['required', 'string'],
            'users_id'          => ['required', 'numeric'],
            'products'          => ['required'],
        ]);
    }

    private function validationOrderCancel($request) 
    {
        return $request->validate([
            'order_condition'   => ['required', 'string'],
        ]);
    }

    private function validationOrderPaid($request) 
    {
        return $request->validate([
            'order_condition'   => ['required', 'string'],
        ]);
    }

    public function validationRemoveProducts($request) 
    {
        return $request->validate([
            'products_id' => ['required'],
        ]);
    }

    public function storeOrder($request) 
    {
        $order = new Order();
        $order->total = 0;
        $order->order_status_id = 1;
        $order->users_id = $request->users_id;
        $order->save();

        $this->addProduct($order->id, $request->products);
        $this->totalOrderAmount($order->id);
        
        return true;
    }

    public function updateOrder($request, $id)
    {
        switch ($request->order_condition) {
            case 'payment_done':
                if ($this->validationOrderPaid($request)) {
                    $this->paidOrder($id, $request->products);
                    $this->totalOrderAmount($id);
                }
                break;

            case 'payment_cancel':
                if ($this->validationOrderCancel($request)) {
                    $this->cancelOrder($id);
                }
                break;
            
            default:
                if ($this->validationUpdate($request)) {
                    $this->removeAllProduct($id);
                    $this->addProduct($id, $request->products);
                    $this->totalOrderAmount($id);
                }
                break;
        }
    }

    public function removeProductOrder($idOrder, $productsId)
    {
        $order = Order::findOrFail($idOrder);
        foreach ($productsId as $id) {
            $order->wherePivot("products_id", $id);
            $order->product()->detach();
        }
        
        $this->totalOrderAmount($idOrder);

        return true;
    }

    private function addProduct($idOrder, $products)
    {
        $orderModel = Order::findOrFail($idOrder);
        foreach($products as $product) {
            $productQuantity = explode('-', $product);
            $orderModel->product()->attach($productQuantity[0], ['quantity' => $productQuantity[1]]);
        }

        return true;
    }

    private function removeAllProduct($idOrder)
    {
        $orderModel = Order::findOrFail($idOrder);
        $orderModel->product()->detach();

        return true;
    }

    private function paidOrder($idOrder, $products)
    {
        try {
            $order = Order::findOrFail($idOrder);
            $order->order_status_id = 2;
            $order->save();

            $this->removeAllProduct($idOrder);
            $this->addProduct($idOrder, $products);

            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    private function totalOrderAmount($idOrder)
    {
        $orderProducts = Order::with('product')->findOrFail($idOrder);
        $total = 0;
        foreach($orderProducts->product as $product) {
            $total += $product->price * $product->pivot->quantity;
        }
        
        $orderProducts->total = $total;
        $orderProducts->save();

        return true;
    }

    private function cancelOrder($idOrder)
    {
        try {
            $order = Order::findOrFail($idOrder);
            $order->order_status_id = 3;
            $order->save();

            return true;
        } catch (QueryException $e) {
            return false;
        }
    }
}

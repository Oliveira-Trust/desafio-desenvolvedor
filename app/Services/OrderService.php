<?php


namespace App\Services;


use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository,$orderItemRepository;

    public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
    }

    public function all()
    {
        return $this->orderRepository->all();
    }

    public function save(array $attributes)
    {
        //saving first order
        $order = $this->orderRepository->create([
            'client_id' => $attributes["client_id"]
        ]);

        //creating order item
        return $this->orderItemRepository->create([
            'quantity' => $attributes["quantity"],
            'price' => $attributes["price"],
            'status' => $attributes["status"],
            'product_id' => $attributes["product_id"],
            'order_id' => $order->id
        ]);
    }

    public function update(array $attributes, int $id)
    {
        return $this->orderRepository->update($id, $attributes);
    }

    public function destroy(int $id)
    {
        return $this->orderRepository->destroy($id);
    }
}

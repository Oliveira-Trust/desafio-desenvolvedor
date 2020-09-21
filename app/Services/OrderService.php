<?php


namespace App\Services;


use App\Repositories\OrderItemRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;

class OrderService
{
    protected $orderRepository, $productRepository, $orderItemRepository;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository, OrderItemRepository $orderItemRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->productRepository = $productRepository;
        $this->orderItemRepository = $orderItemRepository;
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
            'price' => $this->calculateTotalPrice($attributes["product_id"],$attributes["quantity"]),
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

    public function last()
    {
        return $this->orderRepository->last();
    }

    private function calculateTotalPrice(int $productId, int $totalItens){
        $product = $this->productRepository->find($productId);
        return $totalItens * $product->price;
    }
}

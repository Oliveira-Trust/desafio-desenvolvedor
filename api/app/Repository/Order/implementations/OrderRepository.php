<?php

namespace App\Repository\Order\implementations;

use App\Repository\Order\OrderIRepository;
use App\Repository\Order\OrderDTO;
use App\Models\Order\Order;

class OrderRepository implements OrderIRepository {

    public function create(OrderDTO $orderDTO): array {
        $orderDTO = $orderDTO->toArray();
        $order = new Order($orderDTO);
        $order->save();

        $order->products()->sync($orderDTO['products']);
        return $order->toArray();
    }

    public function read(int $id): array {
        try {
            return Order::with(['products','user','customer'])
                ->findOrFail($id)
                ->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function readClean(int $id): array {
        try {
            return Order::with('products')
                ->findOrFail($id)
                ->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function readArray(array $ids): array {
        try {
            return Order::whereIn('id', $ids)
                ->get()
                ->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    public function readAll(): array {
        return Order::with(['products','user','customer'])
            ->get()
            ->toArray();
    }

    public function update(int $id, OrderDTO $orderDTO) : array {
        $order = Order::with('products')->find($id);
        $order->fill($orderDTO->toArray());
        $order->save();

        $order->products()->sync($orderDTO->products);

        $return = $order->toArray();
        $return['products'] = $order->products()
            ->getResults()
            ->toArray();

        return $return;
    }

    public function delete(int $id) : bool {
        return Order::destroy($id);
    }
}
<?php


namespace App\Services;


use App\Repositories\OrderRepository;

class OrderService
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function all()
    {
        return $this->orderRepository->all();
    }

    public function save(array $attributes)
    {
        return $this->orderRepository->save($attributes);
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

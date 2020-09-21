<?php


namespace App\Services;


use App\Repositories\OrderItemRepository;

class OrderItemService
{
    protected $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function all()
    {
        return $this->orderItemRepository->all();
    }

    public function find(int $id){
        return $this->orderItemRepository->find($id);
    }

    public function destroy(int $id)
    {
        return $this->orderItemRepository->destroy($id);
    }

    public function update(array $attributes, int $id)
    {
        return $this->orderItemRepository->update($id, $attributes);
    }
}

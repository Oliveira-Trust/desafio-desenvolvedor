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

    public function find(int $id){
        return $this->orderItemRepository->find($id);
    }
}

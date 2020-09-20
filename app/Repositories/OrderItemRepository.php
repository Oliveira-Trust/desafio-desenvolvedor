<?php


namespace App\Repositories;


use App\Models\OrderItem;

class OrderItemRepository extends BaseRepository
{
    protected $orderItem;

    public function __construct(OrderItem $orderItem)
    {
        parent::__construct($orderItem);
    }
}

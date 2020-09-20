<?php


namespace App\Repositories;


use App\Models\OrderItem;

class OrderItemRepository extends BaseRepository
{
    protected $orderItem;

    protected function __construct(OrderItem $orderItem)
    {
        parent::__construct($orderItem);
    }
}

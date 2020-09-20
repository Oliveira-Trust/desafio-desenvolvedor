<?php


namespace App\Repositories;


use App\Models\Order;

class OrderRepository extends BaseRepository
{
    protected $order;

    public function __construct(Order $order)
    {
        parent::__construct($order);
    }
}

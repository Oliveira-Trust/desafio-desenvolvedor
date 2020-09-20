<?php


namespace App\Repositories;


class OrderRepository extends BaseRepository
{
    protected $order;

    protected function __construct(object $obj)
    {
        parent::__construct($obj);
    }
}

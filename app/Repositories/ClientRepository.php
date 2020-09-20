<?php


namespace App\Repositories;


class ClientRepository extends BaseRepository
{
    protected $client;
    protected function __construct(object $obj)
    {
        parent::__construct($obj);
    }
}

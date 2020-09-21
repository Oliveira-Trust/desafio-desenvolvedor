<?php


namespace App\Repositories;


use App\Models\Client;

class ClientRepository extends BaseRepository
{
    protected $client;
    protected function __construct(Client $client)
    {
        parent::__construct($client);
    }
}

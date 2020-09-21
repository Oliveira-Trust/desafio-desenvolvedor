<?php


namespace App\Services;


use App\Repositories\ClientRepository;

class ClientService
{
    protected $clientRepository;

    public function __construct(ClientRepository $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function all()
    {
        return $this->clientRepository->all();
    }

    public function save(array $attributes)
    {
        return $this->clientRepository->save($attributes);
    }

    public function update(array $attributes, int $id)
    {
        return $this->clientRepository->update($id, $attributes);
    }

    public function destroy(int $id)
    {
        return $this->clientRepository->destroy($id);
    }

    public function find(int $id)
    {
        return $this->clientRepository->find($id);
    }
}

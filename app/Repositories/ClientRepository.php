<?php

namespace App\Repositories;

use App\Models\Client;
use App\Response\JsonResponse;
use App\Repositories\BaseRepository;
use App\Repositories\ClientRepository;
use App\Repositories\StatusRepository;
use Yajra\DataTables\Services\DataTable;
use App\Repositories\Interfaces\IClientRepository;

class ClientRepository extends BaseRepository implements IClientRepository
{
    protected $modelClass;

    /**
     * Create a new ClientRepository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelClass = app(Client::class);
    }

    /**
     * Create a new model instance
     *
     * @param  array  $data
     * @return JsonResponse
     */
    public function create(array $attr) : JsonResponse
    {
        $modelSave = $this->modelClass::create($attr);
        return JsonResponse::success(true, __("Message Success Insert"), $modelSave->toArray());
    }

    /**
     * Update a model instance
     *
     * @param  string  $uuid
     * @param  array  $data
     * @return JsonResponse
     */
    public function update(string $uuid, array $attr) : JsonResponse
    {
        $modelSave = $this->modelClass::where('uuid', $uuid)
            ->update($attr);

        return JsonResponse::success(true, __("Message Success Update"), $this->getById($uuid)->toArray());
    }

    /**
     * Get Statuses to Slients
     *
     * @return array
     */
    public function getClientStatuses() : array
    {
        $statusRepository = app(StatusRepository::class);
        $statuses = $statusRepository->filterByRef($this->modelClass::getTableName(), ['enable' => 1]);
        return $statuses->toArray();
    }

    /**
     * Get Datatable instance
     *
     * @return Yajra\DataTables\EloquentDataTable
     */
    public function getDatatable()
    {
        return datatables()
            ->eloquent($this->modelClass::query())
            ->addColumn('action', 'client.action');
    }
}
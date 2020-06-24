<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Client;
use App\Models\Status;
use App\Models\Product;
use App\Models\OrderProducts;
use App\Response\JsonResponse;
use App\Repositories\BaseRepository;
use App\Repositories\StatusRepository;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IStatusRepository;

class StatusRepository extends BaseRepository implements IStatusRepository
{
    protected $modelClass;

    /**
     * Create a new StatusRepository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelClass = app(Status::class);
    }

    /**
     * Create a new model instance
     *
     * @param  array  $data
     * @return JsonResponse
     */
    public function create(array $attr) : JsonResponse
    {
        if ($attr['status'] == 1 && $this->validStatus($attr)) {
            $statusName = $attr['status'] ? __("Active") : __("Inactive");
            return JsonResponse::success(false, __("status.status_error", ['status' => $statusName]));
        }
        $modelSave = $this->modelClass::create($attr);
        return JsonResponse::success(true, __("Message Success Insert"), []);
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
        if ($attr['status'] > 0 && $this->validStatus($attr, $uuid)) {
            $statusName = $attr['status'] ? __("Active") : __("Inactive");
            return JsonResponse::success(false, __("status.status_error", ['status' => $statusName]));
        }
        $modelSave = $this->modelClass::where('uuid', $uuid)
            ->update($attr);

        return JsonResponse::success(true, __("Message Success Update"), $this->getById($uuid)->toArray());
    }

    /**
     * Get RefTables list
     *
     * @return array
     */
    public function getRefTables() : array
    {
        return [
            Client::getTableName() => __('Client'),
            Product::getTableName() => __('Product'),
            Order::getTableName() => __('Order'),
        ];
    }

    /**
     * Get Statuses list
     *
     * @return array
     */
    public function getStatuses() : array
    {
        return __("status.state.status");
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
            ->addColumn('action', 'status.action');
    }

    /**
     * Filter by Ref Table and parameters
     *
     * @param string $refTable
     * @param array $filter
     * @return Collection 
     */
    public function filterByRef(string $refTable, array $filter = []) : Collection 
    {
        $statusFiltered = $this->modelClass::where('ref_table', $refTable);
        if (!empty($filter)) {
            foreach ($filter as $column => $value) {
                $statusFiltered->where($column, $value);
            }
        }

        return $statusFiltered->get();
    }

    /**
     * Validates if there is another Status with the same reference table
     *
     * @param string $uuid
     * @param array $filter
     * @return bool
     */
    private function validStatus(array $attr, string $uuid = '') : bool
    {
        $statusCount = $this->modelClass::where('ref_table', $attr['ref_table'])
        ->where('enable', Status::ENABLED)
        ->where('status', $attr['status'])
        ->when(!empty($uuid), function ($q) use ($uuid) { 
            return $q->where('uuid', '<>', $uuid);
        })
        ->first();

        return empty($statusCount) ? false : true;
    }
}
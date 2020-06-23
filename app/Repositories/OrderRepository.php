<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderProducts;
use App\Response\JsonResponse;
use App\Repositories\BaseRepository;
use App\Repositories\OrderRepository;
use App\Repositories\StatusRepository;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Interfaces\IOrderRepository;

class OrderRepository extends BaseRepository implements IOrderRepository
{
    protected $modelClass;

    /**
     * Create a new OrderRepository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelClass = app(Order::class);
    }

    /**
     * Return all entries
     *
     * @return Collection
     */
    public function all() : Collection
    {
        return $this->modelClass::query();
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
        $OrderProductsSave = $this->insertOrderProducts($attr);
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
        $OrderProductsSave = $this->insertOrderProducts($attr, $uuid);
        unset($attr['products']);
        $modelSave = $this->modelClass::where('uuid', $uuid)
            ->update($attr);

        return JsonResponse::success(true, __("Message Success Update"), $this->getById($uuid)->toArray());
    }

    /**
     * Get Statuses to Slients
     *
     * @return array
     */
    public function getOrderStatuses() : array
    {
        $statusRepository = app(StatusRepository::class);
        $statuses = $statusRepository->filterByRef($this->modelClass::getTableName(), ['enable' => 1]);
        return $statuses->sortBy('name')->toArray();
    }

    /**
     * Get Datatable instance
     *
     * @return Yajra\DataTables\EloquentDataTable
     */
    public function getDatatable()
    {
        return datatables()
            ->eloquent($this->query())
            ->addColumn('action', 'order.action');
    }

    /**
     * insert OrderProducts
     *
     * @param  array  $data
     * @param  string  $model
     */
    private function insertOrderProducts(array $data, $uuid = false)
    {
        $orderId = $uuid;
        if ($orderId !== false) {
            $orderId = $this->modelClass::orderBy('created_at', 'desc')->first()->getUuid();
        }
        $removeOthers = OrderProducts::where('order_id', $orderId)->delete();
        foreach ($data['products'] as $attr) {
            $attr['order_id'] = $orderId;
            $orderProductsSave = OrderProducts::create($attr);
        }
        return true;
    }
}
<?php

namespace App\Repositories;

use App\Models\Product;
use App\Response\JsonResponse;
use App\Repositories\BaseRepository;
use App\Repositories\ProductRepository;
use App\Repositories\StatusRepository;
use Yajra\DataTables\Services\DataTable;
use App\Repositories\Interfaces\IProductRepository;

class ProductRepository extends BaseRepository implements IProductRepository
{
    protected $modelClass;

    /**
     * Create a new ProductRepository instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelClass = app(Product::class);
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
     * Get images from public folder
     *
     * @return array
     */
    public function getProductImages() : array
    {
        $productImages = [];
        foreach (glob(public_path() . "/img/products/*.png") as $filename) {
            $crashPath = explode('public/', $filename);
            $file = str_replace(".png", "", str_replace("img/products/", "", $crashPath[1]));
            $productImages[$crashPath[1]] = $file;
        }
        return $productImages;
    }

    /**
     * Get Statuses to Slients
     *
     * @return array
     */
    public function getProductStatuses() : array
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
            ->addColumn('action', 'product.action');
    }
}
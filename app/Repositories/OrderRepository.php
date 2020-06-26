<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\BaseRepository;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version June 25, 2020, 2:55 am UTC
*/

class OrderRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'client_id',
        'status_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Order::class;
    }
    
    /**
     * Create model record
     *
     * @param array $input
     *
     * @return Order
     */
    public function create($input)
    {
        $products = $input['products'];
        unset($input['products']);
        $model = $this->model->newInstance($input);
        $model->save();
        $this->organizeOrderProducts($products, $model->id);

        return $model;
    }

    /**
     * Update model record for given id
     *
     * @param array $input
     * @param int $id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     */
    public function update($input, $id)
    {
        $products = $input['products'];
        unset($input['products']);

        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();
        $this->organizeOrderProducts($products, $id);

        return $model;
    }

    private function organizeOrderProducts($input, $orderId) : void 
    {
        $repo = app(OrderProductsRepository::class);
        $antigosOP = $repo->all(['order_id' => $orderId]);
        foreach ($antigosOP as $cada) {
            $repo->delete($cada->id);
        }
        foreach ($input as $orderProduct) {
            $orderProduct = json_decode($orderProduct);
            $organizeData = [
                'qnt' => $orderProduct->qnt,
                'price' => ($orderProduct->qnt * $orderProduct->price),
                'order_id' => $orderId,
                'product_id' => $orderProduct->id,
            ];
            $saveOrderP = $repo->create($organizeData);
        }
    }
}

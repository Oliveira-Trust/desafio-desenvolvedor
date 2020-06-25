<?php

namespace App\Repositories;

use App\Models\OrderProducts;
use App\Repositories\BaseRepository;

/**
 * Class OrderProductsRepository
 * @package App\Repositories
 * @version June 25, 2020, 2:55 am UTC
*/

class OrderProductsRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'qnt',
        'price',
        'order_id',
        'product_id'
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
        return OrderProducts::class;
    }
}

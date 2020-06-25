<?php

namespace App\Repositories;

use App\Models\Status;
use App\Repositories\BaseRepository;

/**
 * Class StatusRepository
 * @package App\Repositories
 * @version June 25, 2020, 2:53 am UTC
*/

class StatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'ref_table',
        'enable',
        'status'
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
        return Status::class;
    }

    /**
     * Get RefTables list
     *
     * @return array
     */
    public function getRefTables() : array
    {
        return [
            'clients' => __('Client'),
            'products' => __('Product'),
            'purchase_orders' => __('Order'),
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
}

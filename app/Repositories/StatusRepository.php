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
        return $this->model::getRefTables();
    }

    /**
     * Get Statuses list
     *
     * @return array
     */
    public function getStatuses() : array
    {
        return $this->model::getStatusLabel();
    }

    /**
     * Validates if there is another Status with the same reference table
     *
     * @param string $uuid
     * @param array $filter
     * @return bool
     */
    private function validStatus(array $attr, string $id = '') : bool
    {
        $statusCount = $this->model::where('ref_table', $attr['ref_table'])
        ->where('enable', Status::ENABLED)
        ->where('status', $attr['status'])
        ->when(!empty($id), function ($q) use ($id) { 
            return $q->whereNotIn('id', [$id]);
        })
        ->first();

        return empty($statusCount) ? false : true;
    }
}

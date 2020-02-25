<?php

namespace App\Repository;

use Illuminate\Support\Facades\Log;

abstract class AbstractRepository
{
    /**
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Query for filters
     */
    public function queryToPaginate(array $params)
    {
        try {
            unset($params['page']);

            $query = $this->model;

            if (isset($params['sort'])) {
                if (isset($params['direction'])) {
                    $query = $query->orderBy($params['sort'], $params['direction']);                    
                } else {
                    $query = $query->orderBy($params['sort']);
                }
            }

            unset($params['sort'], $params['direction']);

            if (!empty($params)) {
                foreach ($params as $field => $value) {
                    $query = $query->where($field, 'like', '%'.$value.'%');
                }                
            }
            
            return $query->paginate();
        } catch (\PDOException $e) {
            Log::error($e->getMessage());

            return [];
        }
    }
}
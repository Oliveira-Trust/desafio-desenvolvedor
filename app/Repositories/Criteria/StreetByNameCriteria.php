<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\App;

/**
 * Class StreetByNameCriteria
 * @package App\Repositories\Criteria
 */
class StreetByNameCriteria extends AbstractCriteria
{
    /**
     * @var
     */
    private $streetName;
    /**
     * @var null
     */
    private $cityName;

    /**
     * StreetByNameCriteria constructor.
     * @param $streetName
     * @param null $cityName
     */
    public function __construct($streetName, $cityName = null)
    {
        $this->streetName = $streetName;
        $this->cityName = $cityName;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $query = $model->join('cities', function ($join) {
            $join->on('cities.id', '=', 'streets.city_id');
            if (!empty($this->cityName))
                $join->where('cities.name_' . App::getLocale(), 'like', '%' . $this->cityName . '%');

        })->where('name', 'like', '%' . strtolower($this->streetName) . '%')->limit(10)->distinct();

        return $query;
    }
}
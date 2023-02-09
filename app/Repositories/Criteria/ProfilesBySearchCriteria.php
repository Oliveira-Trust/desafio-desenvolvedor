<?php

namespace App\Repositories\Criteria;

use Czim\Repository\Criteria\AbstractCriteria;
use DB;

/**
 * Class ProfilesBySearchCriteria
 * @package App\Repositories\Criteria
 */
class ProfilesBySearchCriteria extends AbstractCriteria
{
    const LEFT_WILDCARD = 0;
    const FULL_WILDCARD = 1;
    const RIGHT_WILDCARD = 2;
    const NO_WILDCARD = 3;

    /**
     * @var
     */
    private $queryString;

    /**
     * ProfilesBySearchCriteria constructor.
     * @param $queryString
     */
    public function __construct($queryString, $queryMode = -1)
    {
        $this->queryString = $queryString;
        $this->queryMode = $queryMode;
    }

    /**
     * @param $model
     * @return mixed
     */
    public function applyToQuery($model)
    {
        $model->select([DB::raw('char_length(`profile_labels`.`label`) as `data_length`'), 'profiles.*']);

        switch($this->queryMode) {
            case self::LEFT_WILDCARD:
                $model->where('profile_labels.label', 'like', '%' . $this->queryString);
                break;

            case self::FULL_WILDCARD:
                $model->where('profile_labels.label', 'like', '%' . $this->queryString . '%');
                break;

            case self::RIGHT_WILDCARD:
                $model->where('profile_labels.label', 'like', $this->queryString . '%');
                break;

            case self::NO_WILDCARD:
            default:
                $model->where('profile_labels.label', $this->queryString);
        }

        return $model->orderBy('data_length');

        // require ProfileRepository findByCompany//findByUser to be called
        // previously
        //$model->select([DB::raw('min(char_length(`document_field_string_values`.`data`)) as `data_length`'), 'profiles.*'])
            //->join('document_field_string_values', function($join) {
                //$join->on('document_field_string_values.document_field_id', '=', 'document_fields.id');
            //});

        //switch($this->queryMode) {
            //case self::LEFT_WILDCARD:
                //$model->where('document_field_string_values.data', 'like', '%' . $this->queryString);
                //break;

            //case self::FULL_WILDCARD:
                //$model->where('document_field_string_values.data', 'like', '%' . $this->queryString . '%');
                //break;

            //case self::RIGHT_WILDCARD:
                //$model->where('document_field_string_values.data', 'like', $this->queryString . '%');
                //break;

            //case self::NO_WILDCARD:
            //default:
                //$model->where('document_field_string_values.data', $this->queryString);
        //}

        //return $model->orderBy('data_length');
    }
}

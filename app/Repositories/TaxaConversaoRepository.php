<?php

namespace App\Repositories;

use App\Models\TaxasConversao;
use App\Repositories\BaseRepository;
use DB;

/**
 * Class OrderRepository
 * @package App\Repositories
 * @version June 16, 2019, 8:19 pm UTC
 */

class TaxaConversaoRepository extends BaseRepository
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        //
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
        return TaxasConversao::class;
    }

    /**
     * Configure the Model
     **/
    public function instance()
    {
        $table = TaxasConversao::class;
        return new $table;
    }
}

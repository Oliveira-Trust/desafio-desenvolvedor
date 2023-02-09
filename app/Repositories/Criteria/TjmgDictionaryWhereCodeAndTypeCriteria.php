<?php


namespace App\Repositories\Criteria;


use Czim\Repository\Criteria\AbstractCriteria;

class TjmgDictionaryWhereCodeAndTypeCriteria extends AbstractCriteria
{
    private $code;
    private $type;

    /**
     * @param $code
     * @param $type
     */
    public function __construct($code, $type)
    {
        $this->code = $code;
        $this->type = $type;
    }
    protected function applyToQuery($model)
    {
        $code = $this->code;
        $type = $this->type;

        return $model->where(function($q) use($code, $type){
            $q->where('code','=', $code);
            $q->where('tjmg_tipo_tabela_id','=', $type);
        });
    }
}
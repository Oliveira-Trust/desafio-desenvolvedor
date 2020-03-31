<?php

namespace App\Repositories;

use Danganf\MyClass\Json\Contracts\JsonAbstract;
use Danganf\Repositories\Contracts\RepositoryAbstract;

class ProductRepository extends RepositoryAbstract
{
    public function __construct(){
        parent::__construct( __CLASS__ );
        return $this;
    }

    /**
     * RETORNA PRODUTOS ATIVOS
     * @param array $filterArray
     * @return array
     */
    public function getAvaible( $filterArray = [] ){

        $filter['status'] = 'S';
        $filter['limit']  = 'ALL';
        $filter['dir']    = array_get( $filterArray, 'dir'  , 'asc' );
        $filter['sort']   = array_get( $filterArray, 'sort' , 'name' );
        $filter['search'] = array_get( $filterArray, 'search' );

        unset( $filterArray );

        return $this->filter( $filter );
    }

    /**
     * RETORNA OS PRODUTOS CADASTRADOS COM BASE NOS FILTROS ENVIADOS
     * @param array $filterArray
     * @return array
     */
    public function filter( $filterArray = [] ){

        $limit = array_get( $filterArray, 'limit', 0 );
        $limit = !empty( $limit ) ? $limit : 25;

        $order  = array_get( $filterArray, 'sort'   , 'id' );
        $order .= ' '.array_get( $filterArray, 'dir', 'asc' );

        $where  = '';

        if( !empty( trim( array_get( $filterArray, 'id', '' ) ) ) ){
            $this->setFilter($where, "id='".only_number( $filterArray['id'] )."'");
        }
        if( !empty( trim( array_get( $filterArray, 'search', '' ) ) ) ){
            $this->setFilter($where, "sku='".$filterArray['search']."' or name like '%".$filterArray['search']."%'");
        }
        if( !empty( trim( array_get( $filterArray, 'sku', '' ) ) ) ){
            $this->setFilter($where, "sku='".$filterArray['sku']."'");
        }
        if( !empty( trim( array_get( $filterArray, 'name', '' ) ) ) ){
            $this->setFilter($where, "name like '%".$filterArray['name']."%'");
        }
        if( !empty( trim( array_get( $filterArray, 'status', '' ) ) ) ){
            $filterValue = convert_sn_bool( array_get( $filterArray, 'status', '' ) );
            if( !is_null( $filterValue ) ) {
                $this->setFilter($where, 'status=' . $filterValue);
            }
        }

        $querie = $this->getModel()->OrderByRaw( $order );

        if( !empty( $where ) ){
            $querie = $querie->whereRaw( trim( $where ) );
        }

        if( $limit !== 'ALL' ) {
            $result = $querie->paginate($limit);
        } else {
            $result = $querie->get();
        }

        return $result->isNotEmpty() ? $result->toArray() : [];

    }

    /**
     * CRIA OU ATUALIZA UM PRODUTO
     * @param JsonAbstract $jsonValues
     * @param null $sku
     * @return bool
     */
    public function createOrUpdate(JsonAbstract $jsonValues, $sku=null)
    {
        $return = FALSE;
        $query  = $this->getModel()->whereRaw("sku='".$jsonValues->get('sku')."'");

        if( !empty( $sku ) ) {
            $query->where( 'sku', '!=', $sku );
        }

        if( $query->count() == 0 ){
            $instanceModel = $this->getModel();
        }

        if( isset( $instanceModel ) ){

            $flag = TRUE;
            if( !empty( $sku ) ) {
                $this->findBy( 'sku', $sku);
                if( $this->fails() ){
                    $flag = FALSE;
                    $this->setMsgError( \Lang::get('default.register_not_exist') );
                }
            }
            if( $flag ) {
                foreach ($jsonValues->toArray() as $key => $value) {
                    $this->set( $key, $value );
                }
                $this->save();
                $return = TRUE;
            }

        } else {
            $this->setMsgError( \Lang::get('default.uk_exists') );
        }

        return $return;
    }

    /**
     * REMOVE UM PRODUTO EM LOTE
     * @param JsonAbstract $json
     * @return bool
     */
    public function deleteInBatch( JsonAbstract $json ){
        $this->getModel()->whereIn( 'id', $json->get('ids') )->delete();
        return TRUE;
    }

}
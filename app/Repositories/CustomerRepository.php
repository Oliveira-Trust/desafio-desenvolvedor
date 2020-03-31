<?php

namespace App\Repositories;

use Danganf\MyClass\Json\Contracts\JsonAbstract;
use Danganf\Repositories\Contracts\RepositoryAbstract;

class CustomerRepository extends RepositoryAbstract
{
    public function __construct()
    {
        parent::__construct( __CLASS__ );
    }

    /**
     * RETORNA CLIENTES ATIVOS
     * @param array $filterArray
     * @return array
     */
    public function getAvaible( $filterArray = [] ){

        $filter['status'] = 'S';
        $filter['limit']  = 'ALL';
        $filter['dir']    = array_get( $filterArray, 'dir'  , 'asc' );
        $filter['sort']   = array_get( $filterArray, 'sort' , 'name' );

        unset( $filterArray );

        return $this->filter( $filter );
    }

    /**
     * RETORNA OS CLIENTES CADASTRADOS, DEPENDENDO DO FILTRO FORNECIDO
     * @param array $filterArray
     * @return array
     */
    public function filter( $filterArray = [] ){

        $order  = array_get( $filterArray, 'sort'   , 'id' );
        $order .= ' '.array_get( $filterArray, 'dir', 'asc' );

        $limit = array_get( $filterArray, 'limit', 0 );
        $limit = !empty( $limit ) ? $limit : 25;

        $where  = '';

        if( !empty( trim( array_get( $filterArray, 'search', '' ) ) ) ){
            $this->setFilter($where, "email like '%".$filterArray['search']."%' or name like '%".$filterArray['search']."%'");
        }
        if( !empty( trim( array_get( $filterArray, 'document', '' ) ) ) ){
            $this->setFilter($where, "document='".only_number( $filterArray['document'] )."'");
        }
        if( !empty( trim( array_get( $filterArray, 'id', '' ) ) ) ){
            $this->setFilter($where, "id='".only_number( $filterArray['id'] )."'");
        }
        if( !empty( trim( array_get( $filterArray, 'phone', '' ) ) ) ){
            $this->setFilter($where, "phone='".only_number( $filterArray['phone'] )."'");
        }
        if( !empty( trim( array_get( $filterArray, 'name', '' ) ) ) ){
            $this->setFilter($where, "name like '%".$filterArray['name']."%'");
        }
        if( !empty( trim( array_get( $filterArray, 'email', '' ) ) ) ){
            $this->setFilter($where, "email like '%".$filterArray['email']."%'");
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
     * CRIA OU ATUALIZA UM CLIENTE
     * @param JsonAbstract $jsonValues
     * @param null $id
     * @return bool
     */
    public function createOrUpdate(JsonAbstract $jsonValues, $id=null)
    {
        $return = FALSE;
        $query  = $this->getModel()
                    ->whereRaw("(email='".$jsonValues->get('email')."' or document='".$jsonValues->get('document')."')");

        if( !empty( $id ) ) {
            $query->where( 'id', '!=', $id );
        }

        if( $query->count() == 0 ){
            $instanceModel = $this->getModel();
        }

        if( isset( $instanceModel ) ){

            $flag = TRUE;
            if( !empty( $id ) ) {
                $this->find($id);
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
     * REMOVE CLIENTES EM LOTE
     * @param JsonAbstract $json
     * @return bool
     */
    public function deleteInBatch( JsonAbstract $json ){
        $this->getModel()->whereIn( 'id', $json->get('ids') )->delete();
        return TRUE;
    }
}

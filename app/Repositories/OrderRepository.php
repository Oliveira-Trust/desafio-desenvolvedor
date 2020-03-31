<?php

namespace App\Repositories;

use Danganf\MyClass\Json\Contracts\JsonAbstract;
use Danganf\Repositories\Contracts\RepositoryAbstract;
use Illuminate\Support\Facades\DB;

class OrderRepository extends RepositoryAbstract
{
    public function __construct(){
        parent::__construct( __CLASS__ );
        return $this;
    }

    const STATUS_LABEL = [
        'em_aberto' => 'Em aberto',
        'pago'      => 'Pago',
        'cancelado' => 'Cancelado'
    ];

    /**
     * RETORNA PEDIDOS CADASTRADOS COM BASE NOS FILTROS FORNECIDOS
     * @param array $filterArray
     * @return array
     */
    public function filter( $filterArray = [] ){

        $order  = array_get( $filterArray, 'sort'   , 'id' );
        $order .= ' '.array_get( $filterArray, 'dir', 'asc' );

        $limit = array_get( $filterArray, 'limit', 0 );
        $limit = !empty( $limit ) ? $limit : 25;

        $where  = '';

        if( !empty( trim( array_get( $filterArray, 'id', '' ) ) ) ){
            $this->setFilter($where, "id='".only_number( $filterArray['id'] )."'");
        }
        if( !empty( trim( array_get( $filterArray, 'status', '' ) ) ) ){
            $this->setFilter($where, "status='".$filterArray['status']."'");
        }
        if( !empty( trim( array_get( $filterArray, 'phone', '' ) ) ) ){
            $this->setFilter($where, "customer_phone='".only_number( $filterArray['phone'] )."'");
        }
        if( !empty( trim( array_get( $filterArray, 'name', '' ) ) ) ){
            $this->setFilter($where, "customer_name like '%".$filterArray['name']."%'");
        }
        if( !empty( trim( array_get( $filterArray, 'email', '' ) ) ) ){
            $this->setFilter($where, "customer_email like '%".$filterArray['email']."%'");
        }

        $querie = $this->getModel()
                    ->with(['items'])
                    ->OrderByRaw( $order );

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
     * CRIA UM NOVO PEDIDO
     * @param JsonAbstract $json
     * @param null $id
     * @return array
     */
    public function createOrUpdate( JsonAbstract $json, $id=null ){

        $return = [];

        // BUSCANDO O CLIENTE
        $resultCustomer = $this->getModel()->customer()->getRelated()
                            ->where('status', 1)->where('id', $json->get('customer_id') )
                            ->select('name', 'phone', 'email')->first();

        if( !empty( $resultCustomer ) ){

            $resultCustomer = $resultCustomer->toArray();

            $items = objectToArray( $json->get('items') );

            // BUSCANDO OS ITENS DO PEDIDO
            $resultCatalog = $this->getModel()->items()->getRelated()->catalog()->getRelated()
                ->where('status', 1)
                ->whereIn('id',  pluckMatriz( objectToArray( $items ), 'catalog_id' ) )
                ->select('id', 'name', 'price')->get()->toArray();

            if( count($items) == count( $resultCatalog ) ){

                $grandTotal = 0;

                foreach( $items  as $key => $row ) {
                    $catalog             = current( search_in_array( $resultCatalog, 'id', $row['catalog_id'] ) );
                    $grandTotal         += ( $catalog['price'] * $row['qty'] );
                    $row['catalog_name'] = $catalog['name'];
                    $row['price']        = $catalog['price'];

                    $items[$key] = $row;
                }

                if( $json->get('final_price ') <= $grandTotal ){

                    $this->set( 'customer_id'      , $json->get('customer_id') );
                    $this->set( 'customer_name'    , $resultCustomer['name'] );
                    $this->set( 'customer_email'   , $resultCustomer['email'] );
                    $this->set( 'customer_phone'   , $resultCustomer['phone'] );
                    $this->set( 'grand_total'      , $grandTotal );
                    $this->set( 'final_price'      , $json->get('final_price ') );
                    $this->set( 'discount'         , $grandTotal - $json->get('final_price') );

                    DB::beginTransaction();

                    try{

                        $this->save();
                        $this->find( $this->getModel()->id );

                        foreach (  $items  as $row ) {
                            $modelTmp = $this->getModel()->items()->getRelated();
                            foreach ($row as $key => $value) {
                                $modelTmp->{$key} = !is_null($value) ? (string) $value : null;
                            }
                            $this->getModel()->items()->save($modelTmp);
                        }

                        $return = [
                            'id'         => $this->getModel()->id,
                            'created_at' => $this->getModel()->created_at,
                        ];


                    } catch ( \Exception $e ){
                        DB::rollback();
                        \LogDebug::error( $e->getMessage() );
                        $this->setMsgError( \Lang::get('default.create_error') );
                    }

                    DB::commit();

                } else {
                    $this->setMsgError( \Lang::get('default.value_order_error') );
                }

            } else {
                $this->setMsgError( \Lang::get('default.order_items_not_found') );
            }


        } else{
            $this->setMsgError( \Lang::get('default.customer_not_found') );
        }

        return $return;

    }

    /**
     * REMOVE UM PEDIDO
     * @param $id
     * @param null $fields
     * @return bool
     */
    public function delete($id, $fields=null)
    {
        DB::beginTransaction();
        try {
            $this->getModel()->items()->getRelated()->where('order_id', $id)->delete();
            $return = parent::delete($id, 'id');
        } catch ( \Exception $e ){
            DB::rollback();
            \LogDebug::error( $e->getMessage() );
            $this->setMsgError( \Lang::get('default.internal_server_error') );
            $return = FALSE;
        }
        DB::commit();
        return $return;
    }

    /**
     * ATUALIZA UM PEDIDO PARA UM NOVO STATUS
     * @param $newStatus
     * @return bool
     */
    public function updateStatus( $newStatus ){
        $return = FALSE;
        if( !$this->fails() ){
            if( $this->get('status') === 'em_aberto' ){

                if( array_key_exists( $newStatus, $this::STATUS_LABEL ) ) {
                    $this->set('status', $newStatus)->save();
                    $return = TRUE;
                } else {
                    $this->setMsgError( \Lang::get('default.status_invalid') );
                }
            } else {
                $this->setMsgError( \Lang::get('default.order_status_incorrect') );
            }
        } else {
            $this->setMsgError( \Lang::get('default.register_not_exist') );
        }
        return $return;
    }

    /**
     * REMOVE PEDIDOS EM LOTE
     * @param JsonAbstract $json
     * @return bool
     */
    public function deleteInBatch( JsonAbstract $json ){

        DB::beginTransaction();
        try {
            $this->getModel()->items()->getRelated()->whereIn( 'order_id', $json->get('ids') )->delete();
            $return = $this->getModel()->whereIn( 'id', $json->get('ids') )->delete();
        } catch ( \Exception $e ){
            DB::rollback();
            \LogDebug::error( $e->getMessage() );
            $this->setMsgError( \Lang::get('default.internal_server_error') );
            $return = FALSE;
        }
        DB::commit();
        return $return;
    }
}
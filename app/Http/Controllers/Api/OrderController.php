<?php

namespace App\Http\Controllers\Api;

use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $repository;
    public function __construct( OrderRepository $orderRepository )
    {
        $this->repository = $orderRepository;
    }

    /**
     * @param string $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($id='', Request $request){

        if( empty( $id ) ) {
            $result = $this->repository->filter($request->all());
            $result = format_paginate($result);
            $result['status_label'] = $this->repository::STATUS_LABEL;
            if( !empty( $result ) ){
                multiRenameKey($result['data'], [], [], true, true);
            }
        }
        else {
            $result = $this->repository->setwith('items')->find($id);
            if (!$result->fails()) {
                $result = $result->toArray();
                $result = convert_data_in_row( $result );
                $result = convert_price_in_row( $result );
                multiRenameKey($result['items'], [], [], true, true);
                $result['status_label'] = $this->repository::STATUS_LABEL;
            }
        }

        return msgJson( $result );
    }

    public function create( Request $request ){

        $result = $this->repository->createOrUpdate( $request->get('json') );
        if( !empty( $result ) ){
            return msgJson( $result );
        }
        return msgErroJson( $this->repository->getMsgError() );

    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        if( $this->repository->delete( $id, 'id' ) ){
            return msgSuccessJson('OK');
        }

        return msgErroJson($this->repository->getMsgError());
    }

    public function deleteInBatch( Request $request ){

        $msg = \Lang::get('default.action_error');

        if( $this->repository->deleteInBatch( $request->get('json') ) ){
            return msgSuccessJson('OK');
        }

        return msgErroJson($msg);
    }

    public function updtStatus( $id, $action ){
        if( $this->repository->find($id)->updateStatus( $action ) ){
            return msgSuccessJson('OK');
        }
        return msgErroJson($this->repository->getMsgError());
    }
}

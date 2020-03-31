<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class CatalogController
{
    private $repository;
    public function __construct( ProductRepository $productRepository )
    {
        $this->repository = $productRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAvaible( Request $request ){

        $result = $this->repository->getAvaible( $request->all() );
        if( !empty( $result ) ){
            multiRenameKey($result, [], [], true, true);
        }

        return msgJson( $result );
    }

    /**
     * @param string $sku
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index( $sku='', Request $request){

        if( empty( $sku ) ) {
            $result = $this->repository->filter($request->all());
            $result = format_paginate($result);
            if( !empty( $result ) ){
                multiRenameKey($result['data'], [], [], true, true);
            }
        }
        else {
            $result = $this->repository->findBy('sku', $sku);
            if( !$result->fails() ){
                $result = $result->toArray();
                $result = convert_price_in_row( $result );
                $result = convert_data_in_row( $result );
            }
        }

        return msgJson( $result );
    }

    /**
     * @param null $sku
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create( $sku=null, Request $request){

        $json = $request->get('json');

        if( $request->method() == 'POST' ){$sku=null;}

        if( $this->repository->createOrUpdate( $json, $sku ) === TRUE ) {
            return msgSuccessJson('OK', [], $request->method() === 'POST' ? 201 : 200 );
        } else {
            $msg = $this->repository->getMsgError();
        }

        return msgErroJson($msg);
    }

    /**
     * @param $sku
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($sku){

        $msg = \Lang::get('default.register_not_exist');

        if( $this->repository->delete( $sku, 'sku' ) ){
            return msgSuccessJson('OK');
        }

        return msgErroJson($msg);
    }

    /**
     * @param $sku
     * @param $qtd
     * @return \Illuminate\Http\JsonResponse
     */
    public function stockIn( $sku, $qtd ){

        $msg = \Lang::get('default.register_not_exist');

        if( $this->repository->stockIn( $sku, $qtd ) ){
            return msgSuccessJson('OK');
        }

        return msgErroJson($msg);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteInBatch( Request $request ){

        $msg = \Lang::get('default.action_error');

        if( $this->repository->deleteInBatch( $request->get('json') ) ){
            return msgSuccessJson('OK');
        }

        return msgErroJson($msg);
    }

}
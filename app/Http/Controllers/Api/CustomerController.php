<?php

namespace App\Http\Controllers\Api;

use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController
{
    private $repository;
    public function __construct( CustomerRepository $customerRepository )
    {
        $this->repository = $customerRepository;
    }

    public function getAvaible( Request $request ){
        return msgJson( $this->repository->getAvaible( $request->all() ) );
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
        }
        else {
            $result = $this->repository->find($id);
            if (!$result->fails()) {
                $result = $result->toArray();
            }
        }

        return msgJson( $result );
    }

    /**
     * @param null $id
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create($id=null, Request $request){

        $json = $request->get('json');

        if( $request->method() == 'POST' ){$id=null;}

        if( $this->repository->createOrUpdate($json,$id) === TRUE ) {
            return msgSuccessJson('OK', [], $request->method() === 'POST' ? 201 : 200 );
        } else {
            $msg = $this->repository->getMsgError();
        }

        return msgErroJson($msg);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id){

        $id  = (int) $id;
        $msg = \Lang::get('default.register_not_exist');

        if( $this->repository->delete( $id ) ){
            return msgSuccessJson('OK');
        }

        return msgErroJson($msg);
    }

    public function deleteInBatch( Request $request ){

        $msg = \Lang::get('default.action_error');

        if( $this->repository->deleteInBatch( $request->get('json') ) ){
            return msgSuccessJson('OK');
        }

        return msgErroJson($msg);
    }

}
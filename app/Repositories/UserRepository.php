<?php

namespace App\Repositories;

use Danganf\MyClass\Json\Contracts\JsonAbstract;
use Danganf\Repositories\Contracts\RepositoryAbstract;

class UserRepository extends RepositoryAbstract
{
    public function __construct()
    {
        parent::__construct( __CLASS__ );
    }

    /**
     * VERIFICA A EXISTENCIA DE UM USUARIO COM BASE EM LOGIN E SENHA
     * @param $login
     * @param $pass
     * @return bool
     */
    public function auth( $login, $pass ){
        $return = $this->getModel()->where('email', $login)->where('password', md5( $pass ) )->first();
        if( !empty( $return ) ){
            $return = $return->toArray();
        }
        return $return;
    }

    public function createOrUpdate(JsonAbstract $jsonValues, $id=null)
    {
        //
    }
}

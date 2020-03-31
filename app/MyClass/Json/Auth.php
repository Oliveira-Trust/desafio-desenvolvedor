<?php

namespace App\MyClass\Json;

use Danganf\MyClass\Json\Contracts\JsonAbstract;
use Danganf\MyClass\Json\Contracts\JsonInterface;
use Danganf\MyClass\Validator;

class Auth extends JsonAbstract implements JsonInterface
{
    private $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function set( $stringJson ) {
        $this->setReturnPadrao();
        $this->setJson( json_decode( $stringJson ) );
        $this->validRequiredFields($this->toArray());
        \Request::merge( [ 'json' => $this ] );
        $this->validator = null;
    }

    public function validRequiredFields( $array ) {
        $this->trataDados();
        $array  = $this->toArray();
        $fields = [ 'login', "password" ];

        if ( !$this->validator->valid( $array, $fields ) ) {
            $this->error( $this->validator->error() );
        }

        return TRUE;
    }

    private function trataDados() {

    }
}

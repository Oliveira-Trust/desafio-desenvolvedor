<?php

namespace App\MyClass\Json;

use Danganf\MyClass\Json\Contracts\JsonAbstract;
use Danganf\MyClass\Json\Contracts\JsonInterface;
use Danganf\MyClass\Validator;

class CatalogSave extends JsonAbstract implements JsonInterface
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
        $fields = [ 'name','sku','price','status' ];

        if ( !$this->validator->valid( $array, $fields ) ) {
            $this->error( $this->validator->error() );
        }

        $this->create( 'status', (boolean) trim( $this->get('status') ) );
        $this->create('price', convert_string_float( trim( $this->get('price') ) ) );

        return TRUE;
    }

    private function trataDados() {
        $this->get('status', 0);
    }
}

<?php

namespace App\MyClass\Json;

use Danganf\MyClass\Json\Contracts\JsonAbstract;
use Danganf\MyClass\Json\Contracts\JsonInterface;
use Danganf\MyClass\Validator;

class OrderSave extends JsonAbstract implements JsonInterface
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
        $fields = [ 'customer_id', "final_price", "items" ];

        $this->validator->setRule( 'items', 'required|array' );

        if ( !$this->validator->valid( $array, $fields ) ) {
            $this->error( $this->validator->error() );
        }

        foreach ( $this->get('items') as $items ) {
            if (!$this->validator->valid( objectToArray( $items ), ['catalog_id', 'qty'])) {
                $this->error($this->validator->error());
            }
        }

        $this->create('final_price', convert_string_float( trim( $this->get('final_price') ) ) );

        return TRUE;
    }

    private function trataDados() {
        $this->get('items'   , []);
        $this->get('discount', 0);
    }
}

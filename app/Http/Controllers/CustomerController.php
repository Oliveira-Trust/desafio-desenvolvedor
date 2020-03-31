<?php

namespace App\Http\Controllers;

use App\MyClass\FactoryApis;
use App\MyClass\Traits\OpenViewController;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use OpenViewController;

    private $title    = 'Clientes';
    private $pathView = 'customer';
    private $subtitle;

    public function index( Request $request, FactoryApis $factoryApis ){

        $this->subtitle = 'Clientes';

        $filtersTmp          = getVariablesFilter($request);
        $filtersTmp['limit'] = ( array_get( $filtersTmp, 'limit', 10) );
        $filtersTmp['sort']  = ( array_get( $filtersTmp, 'sort', 'name') );
        $filtersTmp['dir']   = ( array_get( $filtersTmp, 'dir', 'asc') );

        $factoryApis->setFilters( $filtersTmp );
        $result = $factoryApis->get('customer');

        return $this->openView([
            'results'        => array_pull( $result, 'data', [] ),
            'filters'        => $filtersTmp,
            'paginator'      => $result,
        ]);
    }

    public function new(){

        $this->subtitle = 'Novo Cliente';
        return $this->openView([ 'btn' => true ], 'view');
    }

    public function edit($id,FactoryApis $factoryApis){
        $this->subtitle = 'Editar Cliente';

        $data = $factoryApis->get('customer',$id);

        if( empty( $data ) ) {
            abort(404, 'Cliente não encontrado');
        }

        return $this->openView(
            array_merge( $data , [ 'btn' => true ] ),
            'view'
        );
    }

}

<?php

namespace App\Http\Controllers;

use App\MyClass\FactoryApis;
use App\MyClass\Traits\OpenViewController;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    use OpenViewController;

    private $title    = 'Catalogo';
    private $pathView = 'catalog';
    private $subtitle;

    public function index( Request $request, FactoryApis $factoryApis ){

        $this->subtitle = 'Catalogo';

        $filtersTmp          = getVariablesFilter($request);
        $filtersTmp['limit'] = ( array_get( $filtersTmp, 'limit', 10) );
        $filtersTmp['sort']  = ( array_get( $filtersTmp, 'sort', 'name') );
        $filtersTmp['dir']   = ( array_get( $filtersTmp, 'dir', 'asc') );

        $factoryApis->setFilters( $filtersTmp );
        $result = $factoryApis->get('catalog');

        return $this->openView([
            'results'   => array_pull( $result, 'data', [] ),
            'filters'   => $filtersTmp,
            'paginator' => $result,
        ]);
    }

    public function new(){

        $this->subtitle = 'Novo produto';
        return $this->openView([ 'btn' => true ], 'view');
    }

    public function edit($sku,FactoryApis $factoryApis){
        $this->subtitle = 'Editar produto';

        $data = $factoryApis->get('catalog',$sku);

        if( empty( $data ) ) {
            abort(404, 'Produto não encontrado');
        }

        return $this->openView(
            array_merge( $data , ['btn' => true ] ),
            'view'
        );
    }
}

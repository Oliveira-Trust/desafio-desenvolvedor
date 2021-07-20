<?php 

namespace App\Repositories;

use App\Models\Product;

class ProductRepository {

	/**
	 * Busca na tabela products os dados de acordo com filtros e busca no frontend /admin/produtos
	 *
	 * @param array $request
	 * @return void
	 */
	public function search($request){
		$model = app(Product::class);
		$query = $model->query();

        // Ordendando por campo do registro
        switch ($request['sortBy']) {
            case 'id':
            case 'name':
            case 'value':
            case 'enabled':
            case 'created_at':
            case 'updated_at':
                $query->orderBy('products.' . $request['sortBy'], $request['sortDirection']);
                break;
            case 'category':
                $query->orderBy('categories.name', $request['sortDirection']);
                break;
            default:
                # code...
                break;
        }

        $query->join('categories', 'products.category_id', '=', 'categories.id');

        if(isset($request['CreateOrderPage'])){
            $query->where('enabled', 1);
        }

        if(isset($request['info'])){
            $query->where('category_id', $request['info']);
        }

        // Pesquisando o campo dos registros
        if (!empty($request['term']) && !empty($request['field'])) {
            switch ($request['field']) {
                case 'id':
				case 'name':
				case 'value':
				case 'enabled':
				case 'created_at':
				case 'updated_at':
					$term = $request['term'];
					if($request['field'] == 'enable'){
						switch ($request['term']) {
							case 'Sim':
							case 'sim':
								$term = 1;
								break;
							case 'Não':
							case 'Nao':
							case 'não':
							case 'nao':
								$term = 0;
								break;
							default:
								$term = 'ERROR';
								break;
						}
					}
                    $query->where('products.' . $request['field'] , 'LIKE', '%' . $term . '%');
                    break;
                case 'category':
                    $query->where('categories.name', 'LIKE', '%' . $request['term'] . '%');
                    break;
                default:
                    # code...
                    break;
            }
        }

        return $query->paginate(10, [
                        'products.id as pid',
                        'products.name as pname',
                        'products.created_at as pcreated', 
                        'products.updated_at as pupdated',
                        'categories.id as cid',
                        'categories.name as cname',
                        'enabled', 
                        'value', 
                    ]);
	}

	public function query(){
		$model = app(Product::class);
		return $model->query();
	}

	public function find($id){
		$model = app(Product::class);
		return $model->find($id);
	}



    /**
     * calcula o valor total do pedido de acordo com os produtos e quantidade selecionadas
     *
     * @param array $request
     * @return float
     */
    public function calculateTotal($request){
        return array_reduce($request['cart'], function ($carry, $item){
            $model = app(Product::class);
            try {
                $product = $model->find($item['productId']);
            } catch (\Throwable $th) {
                return false;
            }
            $carry += $product->value * $item['productQuantity'];
            return $carry;
        });
    }




}
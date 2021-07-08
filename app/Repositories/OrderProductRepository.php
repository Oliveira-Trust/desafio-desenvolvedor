<?php 

namespace App\Repositories;

use App\Models\Product;
use App\Models\OrderProduct;

class OrderProductRepository {

	public function create($data){
		$model = app(OrderProduct::class);
		return $model->create($data);
	}

	/**
	 * cria os detalhes do pedido com seus produtos de acordo com os dados informados
	 *
	 * @param array $request
	 * @param int $order
	 * @return bool
	 */
    public function createFromData($request, $order){
		$model = app(OrderProduct::class);
		$productModel = app(Product::class);
		
		foreach ($request['cart'] as $key => $value) {
			$product = $productModel->findOrfail($value['productId']);
			
			$data = [
				'order_id'       =>    $order,
				'product_id'     =>    $product->id,
				'value'          =>    $product->value,
				'quantity'     	 =>    $value['productQuantity'],
			];
			$model->create($data);
		}
		return true;
    }


	/**
	 * Busca na tabela order_products os dados de acordo com filtros e busca no frontend /admin/pedidos/NUMERO-DO-PEDIDO
	 *
	 * @param array $request
	 * @return void
	 */
	public function search($request){
		$model = app(OrderProduct::class);
		$query = $model->query();

        // Ordendando por campo do registro
        switch ($request['sortBy']) {
            case 'id':
            case 'value':
            case 'quantity':
                $query->orderBy('order_products.' . $request['sortBy'], $request['sortDirection']);
                break;
            case 'name':
                $query->orderBy('products.name', $request['sortDirection']);
                break;
            default:
                # code...
                break;
        }

        $query
		->join('orders', 'orders.id', '=', 'order_products.order_id')
        ->join('clients', 'orders.client_id', '=', 'clients.id')
        ->join('cities', 'clients.city_id', '=', 'cities.id')
        ->join('states', 'cities.state_id', '=', 'states.id')
        ->join('users', 'clients.user_id', '=', 'users.id')
        ->join('products', 'order_products.product_id', '=', 'products.id')
        ->join('categories', 'products.category_id', '=', 'categories.id')
		;
		
        // Pesquisando o campo dos registros
        if (!empty($request['term']) && !empty($request['field'])) {
            switch ($request['field']) {
                case 'id':
                case 'value':
                case 'quantity':
                    $query->where('order_products.' . $request['field'] , 'LIKE', '%' . $request['term'] . '%');
                    break;
                case 'name':
                    $query->where('products.name', 'LIKE', '%' . $request['term'] . '%');
                    break;
                default:
                    # code...
                    break;
            }
        }

		$query->where('order_id', $request['order_id']);

        return $query->paginate(10, [

			/* 
				
			$query->join('order_products', 'orders.id', '=', 'order_products.order_id')
			->join('order_products', 'order_products.product_id', '=', 'products.id')
			->join('categories', 'products.category_id', '=', 'categories.id')
			->join('products', 'products.category_id', '=', 'categories.id')
			->join('clients', 'orders.client_id', '=', 'client.id')
			->join('users', 'clients.user_id', '=', 'users.id');
			*/
                        'clients.id as cli_id',
                        'clients.document  as cli_document',
                        'clients.phone_number  as cli_phone_number',
                        'clients.phone_number2  as cli_phone_number2',
                        'clients.birth  as cli_birth',
                        'clients.address_zipcode  as cli_address_zipcode',
                        'clients.address_street  as cli_address_street',
                        'clients.address_number  as cli_address_number',
                        'clients.address_complement  as cli_address_complement',
                        'clients.address_neighborhood  as cli_address_neighborhood',
                        //'clients.document  as cli_',

                        'users.id as uid',
                        'users.name as uname',
                        'users.email as uemail',

                        'cities.id as ci_id', 
                        'cities.name as ci_name', 
                        
						'states.abbr as st_abbr', 
						'states.name as st_name', 
                        
						'categories.id as cat_id', 
						'categories.name as cat_name', 
                        
						'products.id as prod_id', 
						'products.name as prod_name', 
						'products.description as prod_desc', 
						'products.value as prod_value', 
						'products.enabled as prod_enabled', 

						'orders.created_at as pcreated', 
                        'orders.updated_at as pupdated',
                        'orders.total as total',
                        'orders.status as status',
                        'orders.paid_at as paid_at',
						
                        'order_products.id as or_prod_id', 
                        'order_products.value as or_prod_value', 
                        'order_products.quantity as or_prod_quantity',
                    ]);
	}


}
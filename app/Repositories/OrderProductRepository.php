<?php 

namespace App\Repositories;

use App\Models\Order;
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





	/**
	 * deleta item em massa /admin/pedidos/{pedido}
	 *
	 * @param array $request
	 * @param string $url
	 * @return void
	 */
	public function deleteInMass($request, $url){
		$model = app(OrderProduct::class);
		
		// product's order
		$order = self::getOrderFromUrl($url)->toArray();

		// get new total
		$newTotalValue = self::calculateNewTotal($order, $request);
		
		$orderModel =  app(Order::class);
		
		// get order to update total value
		$theOrder = $orderModel->find($order[0]['order_id']);

		// get old total value to backup 
		$oldTotal = $theOrder->total;

		$theOrder->total = $newTotalValue;
		try {
			// update order with new value
			$theOrder->update();
			try {
				// delete requested item(s) 
				$model->whereIn('id',  $request['items'])->delete();
			} catch (\Throwable $th) {
				// if has error, back to old value
				$theOrder->total = $oldTotal;
				$theOrder->update();
				return response()->json([ 'status' => false, 'message' => 'Falha ao deletar os itens do pedido pedido. 1'], 400);
			}
		} catch (\Throwable $th) {
			return response()->json([ 'status' => false, 'message' => 'Falha ao atualizar o novo valor do pedido.'], 400);
		}
	}

	/**
	 * get url with order id and explode to get specific part
	 *
	 * @param string $url
	 * @return mixin
	 */
	public static function getOrderFromUrl(string $url){
		$model = app(OrderProduct::class);

		$url = explode('/', $url); 
		$order_id = $url[count($url) - 2];
		
		return $model->where('order_id', $order_id)->get();
	}

	/**
	 * calculate new total of order, based on old items minus deleted item
	 *
	 * @param array $order
	 * @param array $request
	 * @return double
	 */
	public static function calculateNewTotal($order, $request){
		
		// id of order_products 
		$orderProducts =  array_reduce($order, function ($carry, $item){
			//$carry['ids'][$item['id']]		=	$item['id'];
			$carry['values'][$item['id']] = (float) $item['value'] * $item['quantity'];
			return $carry; 
		});
		
		// value of items based on new list
		$arrayDiff_VALUES = array_diff_key($orderProducts['values'], array_flip($request['items']));
		
		// sum all new values
		return array_reduce($arrayDiff_VALUES, function ($carry, $item){
			$carry += $item;
			return $carry; 
		});
	}


}